<?php
declare(strict_types=1);
error_reporting(-1);

/* シリアライズ */
class Hoge
{
    public function __construct(
        private int $num,
    ) {
    }
}
$object = new Hoge(123);
var_dump($object);
// シリアライズをすることで「バイトストリームで表した文字列」に変換し、文字列として保存することが出来るようになります。
$serialize_string = serialize($object);
var_dump($serialize_string);
// 「変換された、バイトストリームで表した文字列」を元のオブジェクト(インスタンス)等に戻すこともできます。これをアンシリアライズ(デシリアライズ)と言います。
$unserialized_object = unserialize($serialize_string);
var_dump($unserialized_object);

// シリアライズでは、「resource型および一部の object 以外」のすべての値を、保存可能な文字列に変換することができます。  
function serializeTest(mixed $v)
{
    echo "serializeTest start \n";
    var_dump($v);
    $serialize_string = serialize($v);
    var_dump($serialize_string);
    $unserialized = unserialize($serialize_string);
    var_dump($unserialized);
    echo "serializeTest end \n";
}
// 文字列
serializeTest('string');
// 数値
serializeTest(12345);
serializeTest(3.1415);
// bool
serializeTest(true);
// null
serializeTest(null);
// 配列
serializeTest([1, "2", [3, 4]]);

// resource型(エラーは出ないが値が壊れる)
serializeTest(fopen(__FILE__, 'r'));

// 一部の object(Fatal error: Uncaught Exception: Serialization of ... になる)
// エラーになるのでコメントアウト
/*
$e = function() {}; // 無名関数は「Closureクラスのインスタンス」を作成する
var_dump($e);
$s = serialize($e);
*/

/* __sleep() と __wakeup()、__serialize()と__unserialize() */
// __sleep() と __wakeup()
class SleepWakeupClass
{
    public function __construct(
        private int $num,
        private string $hidden,
        private bool $b,
    ) {
    }
    // `__sleep()` は「シリアライズ(保存)したいプロパティ名の配列を返す」ように作られます
    public function __sleep(): array
    {
        var_dump(__METHOD__);
        return ['num', 'b'];
    }
    // `__wakeup()` は「アンシリアライズ時の処理」を記載します
    public function __wakeup(): void
    {
        var_dump(__METHOD__);
        $this->hidden = '******';
    }
}
$object = new SleepWakeupClass(123, 'string', true);
var_dump($object);
// シリアライズする(プロパティ hidden の情報は抜いてある)
$serialize_string = serialize($object);
var_dump($serialize_string);
// プロパティ hidden の情報は__wakeup()で値を入れてある
$unserialized_object = unserialize($serialize_string);
var_dump($unserialized_object);

// __serialize()と__unserialize()
class SerializeUnserializeClass
{
    public function __construct(
        private int $num,
        private string $hidden,
        private bool $b,
    ) {
    }
    // `__serialize()` は「シリアライズ(保存)したいプロパティの、名前と値を連想配列にして返す」ように作られます
    public function __serialize(): array
    {
        var_dump(__METHOD__);
        return [
            'num' => $this->num,
            'hidden' => $this->hidden,
        ];
    }
    // `__unserialize()` は「引数で(恐らくは `__serialize()` でreturnされたであろう)連想配列」を受け取ります。それを「自分のプロパティに入れる」処理を任意に書く事が出来ます
    public function __unserialize(array $data): void
    {
        var_dump(__METHOD__);
        foreach (['num', 'hidden'] as $s) {
            $this->$s = $data[$s];
        }
        $this->b = false;
    }
}
$object = new SerializeUnserializeClass(123, 'string', true);
var_dump($object);
// シリアライズする(プロパティ hidden の情報は抜いてある)
$serialize_string = serialize($object);
var_dump($serialize_string);
// プロパティ hidden の情報は__wakeup()で値を入れてある
$unserialized_object = unserialize($serialize_string);
var_dump($unserialized_object);

// 
class SleepWakeupSerializeUnserializeClass
{
    public function __construct(
        private int $num,
        private string $hidden,
        private bool $b,
    ) {
    }
    // `__sleep()` は「シリアライズ(保存)したいプロパティ名の配列を返す」ように作られます
    public function __sleep(): array
    {
        var_dump(__METHOD__);
        return ['num', 'b'];
    }
    // `__wakeup()` は「アンシリアライズ時の処理」を記載します
    public function __wakeup(): void
    {
        var_dump(__METHOD__);
        $this->hidden = '******';
    }
    // `__serialize()` は「シリアライズ(保存)したいプロパティの、名前と値を連想配列にして返す」ように作られます
    public function __serialize(): array
    {
        var_dump(__METHOD__);
        return [
            'num' => $this->num,
            'hidden' => $this->hidden,
        ];
    }
    // `__unserialize()` は「引数で(恐らくは `__serialize()` でreturnされたであろう)連想配列」を受け取ります。それを「自分のプロパティに入れる」処理を任意に書く事が出来ます
    public function __unserialize(array $data): void
    {
        var_dump(__METHOD__);
        foreach (['num', 'hidden'] as $s) {
            $this->$s = $data[$s];
        }
        $this->b = false;
    }
}
$object = new SleepWakeupSerializeUnserializeClass(123, 'string', true);
var_dump($object);
// `__sleep()` と `__serialize()` が共に存在する場合、`__serialize()` が呼ばれます(`__sleep()` は呼ばれません)。  
$serialize_string = serialize($object);
var_dump($serialize_string);
// `__wakeup()` と `__unserialize()` が共に存在する場合、`__unserialize()` が呼ばれます(`__wakeup()` は呼ばれません)。  
$unserialized_object = unserialize($serialize_string);
var_dump($unserialized_object);
