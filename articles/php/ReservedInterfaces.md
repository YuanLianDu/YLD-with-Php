# 预定义接口

+ Traversable 遍历接口
+ Iterator（迭代器）接口
+ IteratorAggregate（聚合式迭代器）接口
+ ArrayAccess（数组式访问）接口
+ Serializable（序列化接口）接口
+ Closure 类 [已完成的学习笔记](https://github.com/YuanLianDu/YLD-with-Php/blob/master/articles/php/Closure.md)
+ Generator,生成器类

之前，已经学习了`Closure`,今天系统的学习一下其他预定义接口～～

## Traversable

遍历接口，检测一个类是否可以使用`foreach`进行遍历的接口。
它不能直接被实现。即创建一个类来`implements`此接口。
但是`Iterator` 和 `IteratorAggregate`这两个预定义接口 继承了 `Traversable`,所以可以实现`Iterator` 和 `IteratorAggregate`。


## Iterator

可在内部迭代自己的外部迭代器或类的接口。

源码结构：
```
Iterator extends Traversable {
    public function current();// 返回当前元素
    public function next(); // 移动到下一个元素
    public function key();// 返回当前键
    public function valid(); //检查当前位置是否有效
    public function rewind();    // 返回迭代器的第一个元素
}
```

探究一下迭代器调用方法的顺序

代码：

```
class IteratorInterface implements Iterator
{

	private $position = 0;

	private $array = array('one','two','three');

	public function __construct() {
		$this->position = 0;
	}
	
	// 返回当前元素
	public function current() {
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}

    // 返回当前键
	public function key() {
		var_dump(__METHOD__);
		return $this->position;
	}

    // 移动到下一个元素
	public function next() {
		var_dump(__METHOD__);
		++$this->position;
	}

    // 返回迭代器的第一个元素
	public function rewind() {
		var_dump(__METHOD__);
		$this->position = 0;
	}
    
    //检查当前位置是否有效
	public function valid() {
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}

}

$test = new IteratorInterface();

foreach($test as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}
```

输出：
```
string(25) "IteratorInterface::rewind"
string(24) "IteratorInterface::valid"
string(26) "IteratorInterface::current"
string(22) "IteratorInterface::key"
int(0)
string(3) "one"

string(23) "IteratorInterface::next"
string(24) "IteratorInterface::valid"
string(26) "IteratorInterface::current"
string(22) "IteratorInterface::key"
int(1)
string(3) "two"

string(23) "IteratorInterface::next"
string(24) "IteratorInterface::valid"
string(26) "IteratorInterface::current"
string(22) "IteratorInterface::key"
int(2)
string(5) "three"

string(23) "IteratorInterface::next"
string(24) "IteratorInterface::valid"

```

所以顺序是：

+ 先执行`rewind`，获取第一个元素，0
+ 然后执行`valid`，判断该键＝0是否存在
+ 然后执行`current`，返回当前元素，0对应的值
+ 然后执行`key`，返回当前键值0
+ 然后执行`next`，移动到下一个元素，1
+ 然后执行`valid`，判断键＝1时，元素是否存在。不存在，将不再执行；存在继续执行


## IteratorAggregate

创建外部迭代器的接口。

源码：

```
IteratorAggregate extends Traversable {

    public function getIterator();	//获取一个外部迭代器，
}
```

使用方法：

```
class IteratorAggregateInterface implements IteratorAggregate {

	public $property1 = 'public property one';
	public $property2 = 'public property three';
	public $property3 = 'public property three';

	public function __construct() {
		var_dump(__METHOD__);
		$this->lastProperty = 'last property';
	}
	
	//获取一个外部迭代器，foreach 该类所实例化的对象时，才会执行此方法～
	public function getIterator() {
		var_dump(__METHOD__);
		var_dump($this);
		return new ArrayIterator($this);
	}
}


$test = new IteratorAggregateInterface;
foreach($test as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}
```

输出：
```
string(39) "IteratorAggregateInterface::__construct"
string(39) "IteratorAggregateInterface::getIterator" //在执行foreach时，才会执行这个方法
object(IteratorAggregateInterface)#1 (4) {
  ["property1"]=>
  string(19) "public property one"
  ["property2"]=>
  string(21) "public property three"
  ["property3"]=>
  string(21) "public property three"
  ["lastProperty"]=>
  string(13) "last property"
}    //打印的$this结构
string(9) "property1"
string(19) "public property one"

string(9) "property2"
string(21) "public property three"

string(9) "property3"
string(21) "public property three"

string(12) "lastProperty"
string(13) "last property"

```

## ArrayAccess

提供像访问数组一样访问对象的能力的接口。

源码：

```
interface ArrayAccess { 
       
     // 检查一个偏移位置是否存在
     public function offsetExists($offset);
     // 获取一个偏移位置的值
     public function offsetGet($offset);
     // 设置一个偏移位置的值
     public function offsetSet($offset, $value);
     // 复位一个偏移位置的值
     public function offsetUnset($offset);
}
```

使用方法：

```
class Object implements ArrayAccess {

	private $container = array();

	public function __construct() {
		$this->container = array(
			'one' => 1,
			'two' => 2,
			'three' => 3,
		);
	}

	public function offsetExists($offset) {
		var_dump(__METHOD__);
		return isset($this->container[$offset]);
	}

	public function offsetGet($offset) {
		var_dump(__METHOD__);
		return $this->container[$offset];
	}

	public function offsetSet($offset,$value) {
		var_dump(__METHOD__);
		if(is_null($offset)) {
			$this->container[] = $value;
		}else {
			$this->container[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		var_dump(__METHOD__);
		unset($this->container[$offset]);
	}
}

$obj = new Object();
```

按照步骤执行以下代码，可以看到类内部的函数调用情况：

1、 `var_dump(isset($obj['two']));` 

输出：

```
string(20) "Object::offsetExists"
bool(true)
```

2、`var_dump($obj['two']);`

输出：

```
string(17) "Object::offsetGet"
int(2)
```

3、 代码：
```
unset($obj['two']);
var_dump(isset($obj['two']));
```

输出：

```
string(19) "Object::offsetUnset"
string(20) "Object::offsetExists"
bool(false)
```

4、 代码：

```
$obj["two"] = "A value";
var_dump($obj["two"]);
```

输出：

```
string(17) "Object::offsetSet"
string(17) "Object::offsetGet"
string(7) "A value"
```

5、 代码：
```
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);
```

输出：

```
Object Object
(
    [container:Object:private] => Array
        (
            [one] => 1
            [two] => 2
            [three] => 3
            [0] => Append 1
            [1] => Append 2
            [2] => Append 3
        )
)
```

## Serializable，序列化接口

实现此接口的类将不再支持 __sleep() 和 __wakeup()。

源码：

```
interface Serializable {
    public function serialize();
    public function unserialize($serialized);
}
```

使用方式：

```
class TestSerialize implements  Serializable {

	private $data;

	public function __construct() {
		$this->data = "TestSerialize data";
	}

	public function serialize() {
		var_dump(__METHOD__);
		return serialize($this->data);
	}

	public function  unserialize($data) {
		var_dump(__METHOD__);
		$this->data = unserialize($data);
	}

	public function getData() {
		var_dump(__METHOD__);
		return $this->data;
	}
}

class Test {
	private $data;

	public function __construct() {
		$this->data = 'Test data';
	}

	public function getData() {
		return $this->data;
	}
}

// 测试实现接口`Serializable`
$testSerialize = new TestSerialize;
$testSerialize = serialize($testSerialize);
var_dump($testSerialize);
$testSerialize = unserialize($testSerialize);
var_dump($testSerialize->getData());

// 测试没有实现接口`Serializable`
$test = new Test;
$test = serialize($test);
var_dump($test);
$test = unserialize($test);
var_dump($test);
var_dump($test->getData());
```


输出结果分别是：

```
string(24) "TestSerialize::serialize"
string(52) "C:13:"TestSerialize":26:{s:18:"TestSerialize data";}"
string(26) "TestSerialize::unserialize"
string(22) "TestSerialize::getData"
string(18) "TestSerialize data"
```

和

```
string(49) "O:4:"Test":1:{s:10:"Testdata";s:9:"Test data";}"
object(Test)#2 (1) {
  ["data":"Test":private]=>
  string(9) "Test data"
}
string(9) "Test data"
```

思考：实现`serializable`接口与否，其执行结果一样，意义在于什么？？？？？

## Generator生成器类

Generator 对象是从 generators返回的.

Generator 对象不能通过 new 实例化.


持续补充ing

疑问：究竟在什么情境中，使用这些预定义接口？？？？