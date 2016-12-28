<?php

/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 16/12/27
 * Time: 16:51
 */
class IteratorInterface implements Iterator
{

	private $position = 0;

	private $array = array('one','two','three');

	public function __construct() {
		$this->position = 0;
	}
	public function current() {
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}

	public function key() {
		var_dump(__METHOD__);
		return $this->position;
	}

	public function next() {
		var_dump(__METHOD__);
		++$this->position;
	}

	public function rewind() {
		var_dump(__METHOD__);
		$this->position = 0;
	}

	public function valid() {
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}

}

class IteratorAggregateInterface implements IteratorAggregate {

	public $property1 = 'public property one';
	public $property2 = 'public property three';
	public $property3 = 'public property three';

	public function __construct() {
		var_dump(__METHOD__);
		$this->lastProperty = 'last property';
	}
	public function getIterator() {
		var_dump(__METHOD__);
		var_dump($this);
		return new ArrayIterator($this);
	}
}

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

$testSerialize = new TestSerialize();
$test = new Test;
$testString = 'test string';

/*$testSerialize = serialize($testSerialize);
var_dump($testSerialize);
$testSerialize = unserialize($testSerialize);
var_dump($testSerialize->getData());*/

$test = serialize($test);
var_dump($test);
$test = unserialize($test);
var_dump($test);
var_dump($test->getData());

/*$testString = serialize($testString);
var_dump($testString);
$testString = unserialize($testString);
var_dump($testString);*/



/*$obj = new Object();
var_dump(isset($obj['two']));
var_dump($obj['two']);
unset($obj['two']);
var_dump(isset($obj['two']));
$obj["two"] = "A value";
var_dump($obj["two"]);
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);*/

/*$test = new IteratorAggregateInterface;
foreach($test as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}*/
die();
/*$array = array('one','two','three');
var_dump($array instanceof Iterator);*/
/*$test = new IteratorInterface();

foreach($test as $key => $value) {
	var_dump($key, $value);
	echo "\n";
}*/

//$test = ['hahah'=>111];