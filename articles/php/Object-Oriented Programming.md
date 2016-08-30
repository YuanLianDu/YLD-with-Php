# 面向对象编程

类的构造主要有属性和操作组成；

```
class A {
public $a_one;//属性 可以被外部访问，可以被继承
protected $a_two = 'i'm two in class A';//属性 不可以被外部访问，可以被继承
private $a_three;//属性 不可以被外部访问，不可以被继承

/**
*操作 构造函数，创建一个对象时，将调用构造函数，进行一些有用的初始化任务；
*如设置属性的初始值，或者创建该对象需要的其他对象
*/
function __construct($param) {
    //在一个类中有一个特殊的指针$this，可以引用当前类的属性和方法
    $this->a_one = $param;
}

/**
*操作 
*可以被外部访问，可以被继承
*/
public fucntion one() {
    echo 'I'm function one in class A';
}

/**
*操作
*不可以被外部访问，可以被继承
*/
protected function two() {
    echo 'I'm fuction two in class A';   
}

/**
*操作
*不可以被外部访问，不可以被继承
*/
private function three() {
    echo 'I'm function three in class A';
}

/**
*操作
*禁止被子类重载
*/
final function four() {
    echo 'I'm function four in class A';
}
}

//禁止被继承
final class B {} 
```


类的实例化
```
$object_one = new A('1');//实例化一个对象，使用`new`关键字
echo $object_one->a_one;//调用类的属性
$object_one->one();//调用类的方法
```

类的继承：继承是单向的，子类可以从父类或超类继承特性；子类可以重写父类的属性和方法；

```
class C extends A {
    
    //赋予该属性与父类不同的值
    protected $a_two = 'i'm in class C';
    
    //赋予该操作与父类不同的行为
    public function one() {
       echo 'I'm function one in class C';
    }
}

```

```
$object_a = new A('hahaha');
echo $object_a->a_two;
$object_a->one;
```
输出：
`i'm two in class A`
`I'm function one in class A`


```
$object_c = new C();
echo object_c->a_two;
$object_c->one;
```

输出：
`i'm in class C`
`'I'm function one in class C';`

+ 子类定义新的属性和方法不会影响那个超类（即类A），在子类中重载的属性和操作也不会影响
超类（即类A）。
+ 如果子类重写了父类的属性和方法，则子类的实例化对象，优先调用子类的重写的方法和属性。
+ 想在子类调用父类的方法或属性可以使用`parent`，`parent::one()`

PHP不支持多重继承，即PHP不支持同时继承两个父类；但是支持类B继承类A,类C继承类B；

如果要实现多重继承的功能，使用接口。

```
interface a
{
    public function foo();
}

interface b
{
    public function bar();
}

interface c extends a, b
{
    public function baz();
}

class d implements c
{
    public function foo()
    {
    }

    public function bar()
    {
    }

    public function baz()
    {
    }
}
```

+ 接口中定义的所有方法都必须是公有，这是接口的特性
+ 要实现一个接口，使用 implements 操作符
+ 类中必须实现接口中定义的所有方法，否则会报一个致命错误
+ 类可以实现多个接口，用逗号来分隔多个接口的名称



