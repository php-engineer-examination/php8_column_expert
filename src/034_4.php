<?php
declare(strict_types=1);
error_reporting(-1);

/* __toString() */
// オブジェクト(インスタンス)が文字列にキャストされる時の挙動を決める事ができます。  
class ToString
{
    public function __construct(
        private int $num,
    ){}

    public function __toString(): string
    {
        return sprintf("num is %d", $this->num);
    }
}
$object = new ToString(123);
var_dump( (string)$object );
echo $object , "\n";
// Stringable インタフェースは、マジックメソッド __toString() が定義されているあらゆるクラスで 暗黙のうちに存在すると見なされます
var_dump( $object instanceof Stringable);


/* __invoke() */
class Invoke
{
    public function __construct(
        private int $num,
    ){}
    
    public function  __invoke( ...$values)
    {
        echo "run __invoke() \n";
        var_dump($this->num);
        var_dump($values);
    }
}
$object = new Invoke(123);
$object();
$object(1, '2nd', 3.14);


/* __set_state() */
class SetState
{
    public function __construct(
        private int $num,
        private string $str,
        private float $f,
    ){}

    public static function __set_state(array $properties): static
    {
        echo "run __set_state() \n";
        $obj = new static($properties['num'], $properties['str'], $properties['f']);
        $obj->num *= 2;
        $obj->str .= ' add';
        $obj->f *= 2;
        return $obj;
    }
}
$object = new SetState(123, '2nd', 3.14);
$object_string = var_export($object, true);
var_dump($object_string);
eval("\$object2 = {$object_string};");
var_dump($object2);


/* __debugInfo() */
class DebugInfo
{
    public function __construct(
        private int $id,
        private string $email,
        private string $password,
    ){}

    public function  __debugInfo(): array
    {
        return [
            'id' => $this->id,
            'email' => 'masked',
        ];
    }
}
$object = new DebugInfo(1, 'email@example.com', 'password');
var_dump($object);
