# 自动加载与命名空间：


## __autoload，加载未定义的类

1、全局函数，在new一个对象时，会自动调用。`__autoload`的目的是，找到目标文件并加载；这样，我们就不需要手动require那么多文件了～

autoload.php 文件

```
<?php
function __autoload($className) {
	echo 'autoload: ' . $className;
}
new Demo();
```

返回：

```
autoload: Demo 
Fatal error:  Class 'Demo' not found
```

从上面的例子，可以得知,

+ 在new一个对象时，会自动调用`__autoload`函数;
+ 并且自动向`autoload`函数传递了类名`$className`;

如果想要找到目标文件并加载，需要三步：

+ 根据类名，确定类文件名；
+ 确定类文件所在的磁盘路径；
+ 将所需要的类从磁盘文件路径中加载到项目里；

2、根据上面三步，我们可以将代码改一下：

autoload.php文件

```
<?php
function __autoload($className) {
	$file = __DIR__.'/'.$className. '.php';
    	if (file_exists($file)) {
    		require $file;
    	}
}
new Demo();
```

与`autoload.php`同层级，创建`Demo.php`文件

```
<?php
class Demo
{

	public function __construct() {
		echo "create demo instance success";
	}
}
```

在终端，进入该文件目录，执行`php autoload.php`
结果为：`create demo instance success`
这说明，`__autoload`函数找到类文件并正确加载了文件。

3、**但是，这里有一个问题。注意，我们的`Demo.php`文件同`autoload.php`文件在同一层级。为了代码好管理，我们肯定有与`autoload.php`不同层级的代码文件。**

我们可以用一个数组来存储各种路径，我们继续修改上面的代码：

autoload.php 文件

```
<?php
function __autoload($className) {
	$dirs = array(
		__DIR__,
		__DIR__ . '/Demo/',
	);
	
	foreach($dirs as $dir) {
		$file = $dir.'/'.$className. '.php';
		if (file_exists($file)) {
			require $file;
		}
	}
}

```

创建一个目录`Demo`，并在此目录创建一个文件`Test.php`，代码如下：

```
<?php
class Test {
	public function __construct() {
		echo "create a test in Demo/Test.php \n";
	}
}
```

并在`autoload.php`文件中添加代码：

```
$test = new Test();
```

返回结果，`create a test in Demo/Test.php`

4、不同层级的问题我们也解决了～

**可是还有一个问题，如果目录`Demo`下也有一个类叫`Demo`，会是什么样的结果？？我们来测试一下**

在`Demo`目录新创建一个类`Demo`，代码如下:

```
<?php

class Demo {
	public function __construct() {
		echo "I'm class Demo In the Demo directory";
	}
}
```

返回结果`PHP Fatal error:  Cannot redeclare class Demo`;

5、**现在报错，提示没有办法分辨是那一个class Demo了，现在怎么办呢？**

**我们可以使用命名空间**[具体使用方法详见PHP手册](http://php.net/manual/zh/language.namespaces.rationale.php)

我们将`autoload.php`、`Demo/Demo.php`分别修改如下

```
// autoload.php 
<?php
use Demo\Demo as DemoBother;

function __autoload($className) {
	$dirs = array(
		__DIR__,
		__DIR__ . '/Demo/',//将存在的路径加入
	);

     echo $className."\n";//打印，会发现，只打印出了一个$className
     
	foreach($dirs as $dir) {
		$file = $dir.'/'.str_replace('\\', '/', $className). '.php';

		if (file_exists($file)) {
		    echo $file."\n";
			require $file;
		}
	}
}

$demo = new Demo();
$demoBother = new DemoBother();


// Demo/Demo.php
<?php
namespace Demo;
class Demo {
	public function __construct() {
		echo "I'm class Demo In the Demo directory";
	}
}
```

返回结果：

```
Demo
/Users/yuan/PhpstormProjects/HeadFirst/Demo.php
/Users/yuan/PhpstormProjects/HeadFirst/Demo//Demo.php
create demo instance success 
I'm class Demo In the Demo directory
```

我们成功的解决了，不同层级存在相同类名的问题～

6、**如果使用了use别名，className只传入了一次，便找到了两个Demo.php**

7、**在PHP手册中，提醒我们**
> [spl_autoload_register()](http://php.net/manual/zh/function.spl-autoload-register.php) 提供了一种更加灵活的方式来实现类的自动加载。因此，不再建议使用 __autoload() 函数，在以后的版本中它可能被弃用。


我们可以用`spl_autoload_register()`，注册不同的自定义的自动加载函数。它不仅很灵活，效率也更高。
所以，我们将`autoload.php`代码修改如下：

```
<?php
function autoload($class) {
	static $map = array();
	$dirs = array(
		__DIR__,
		__DIR__.'/Demo/',
	);

	if(!isset($map[$class])) {
		foreach ($dirs as $dir) {
			$file = $dir.'/'.str_replace('\\', '/', $class). '.php';
			if (file_exists($file)) {
				require $file;
				$map[$class] = true;
			}
		}
	}
}

//注册
spl_autoload_register('autoload');
```

**注：每一个添加的autoload函数，都是被塞到一个autoload处理的队列里，就像排队一样。当new一个类的时候，它会按照塞进去的顺序，及排队的顺序，先到先得，直到它找到要new的类，就会自动停止。**

但是，还是有一个问题，只能在`autoload.php`文件里，use其他类，然后创建对象；否则，会报错`Fatal error:  Class not found`。
如何，不用**每次**都在文件先写一个自动加载函数，然后注册，然后才能创建其他类～～？？？




参考文章：

+ [PHP命名空间 namespace 如何实现自动加载](https://segmentfault.com/q/1010000002426493)
+ [Example Implementations of PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md)
+ [PHP中自动加载的几种实现](http://blog.wuxu92.com/php-using-spl-autoloader/)
+ [SplClassLoader](https://gist.github.com/jwage/221634)
+ [PHP的类自动加载机制](http://blog.csdn.net/hguisu/article/details/7463333)
+ [细说“PHP类库自动加载”](https://github.com/qinjx/adv_php_book/blob/master/class_autoload.md)
+ [PHP命名空间namespace使用之spl_autoload](http://blog.zhengshuiguang.com/php/spl_autoload.html)
+ [PHP命名空间和自动加载类](https://segmentfault.com/a/1190000004851664)
+ [PHP命名空间下的自动加载](https://www.hongweipeng.com/index.php/archives/807/)
+ [PHP use类文件中的命名空间问题解析](https://segmentfault.com/a/1190000002528762)