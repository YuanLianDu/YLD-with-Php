# Closure－－闭包

预定义接口

+ Traversable 遍历接口
+ Iterator（迭代器）接口
+ IteratorAggregate（聚合式迭代器）接口
+ ArrayAccess（数组式访问）接口
+ Serializable（序列化接口）接口
+ Closure 类
+ Generator,生成器类

## Closure::__construct 匿名函数：
```
$message = 'world';

// Closures can also accept regular arguments
$example = function ($arg) use ($message) {
    var_dump($arg . ' ' . $message);
};
$example("hello");
```

### 在函数中调用匿名函数
```
function closureInFunction() {
	$closure = function($str) {
		echo $str;
	};
	return $closure('closureInFunction');
}

closureInFunction();
//输出：closureInFunction
```

### 在函数中返回函数

```
function returnClosureInFunction() {
	$closure = function($str) {
		echo $str;
	};

	return $closure;
}

$getClosure = returnClosureInFunction();
$getClosure('return Closure In Function');

// 输出：return Closure In Function
```

### 把匿名函数当做参数传递

```
function invokeClosureFunction($func,$content) {
		$func($content);
}

$closure = function($content) {
	echo $content;
};

invokeClosureFunction($closure,'closure function can as parameter');

// 输出：closure function can as parameter
```

### 匿名函数调用外部变量

```
function echoStr(){
	$num = 1;

	$invokeOutsideParam = function () use($num) {
		echo $num;
		$num ++;
	};//使用use 调用匿名函数的外部参数

	$invokeOutsideParam();//执行匿名函数
	echo $num;
}
输出： 11
// use 只是引用了$num的副本


/**
*完全引用$num，而不是copy$num
*修改函数
*/
function echoStr(){
	$num = 1;

	$invokeOutsideParam = function () use(&$num) {
		echo $num;
		$num ++;
	};

	return $invokeOutsideParam;//返回匿名函数
}

$echostr = echoStr();
$echostr();
$echostr();
// 输出12
```

## Closure::bind：复制一个闭包，绑定指定的$this对象和类作用域

`public static  Closure::bind(Closure $closure,$newthis,$newscope)`
+ `$closure`,匿名函数
+ `$newthis`，需要绑定到匿名函数的对象，或者 NULL 创建未绑定的闭包。
+ `$newscope`，想要绑定给闭包的类作用域，或者 'static' 表示不改变。

## Closure::bindTo — 复制当前闭包对象，绑定指定的$this对象和类作用域。
`public Closure::bindTo($newthis,$newscope)`
+ `newthis` 对象或null
+ `newscope`

`is_callable`: 判断是否为匿名函数。

`array_walk`:使用自定义函数对数组中的每个元素做回调处理；自定义函数，第一个参数是数组键值；第二个参数是数组键名。
在闭包中可以使用:

## Function Handling 函数
+ `call_user_func(Closure $callback,mixed $parameter)`,调用匿名函数。
+ `func_num_args()`:函数，返回传递给函数的参数个数；
+ `func_get_arg($num)`:函数，返回参数列表的某一项，$num从0开始；
+ `func_get_args()`:函数，返回一个数组，其中每个元素都是目前用户自定义函数的参数列表的相应元素的副本。；


持续补充ing


参考
+ [浅析 PHP 闭包--光头哥](https://segmentfault.com/a/1190000002538592)
+ [现代 PHP 新特性系列（五） —— 闭包和匿名函数-- 学院君](http://laravelacademy.org/post/4341.html)
+ [ 深入理解PHP之匿名函数-- 风雪之隅](http://www.laruence.com/2010/06/20/1602.html)
+ [PHP闭包（Closure）初探-- 豆浆油条](http://www.cnblogs.com/melonblog/archive/2013/05/01/3052611.html)