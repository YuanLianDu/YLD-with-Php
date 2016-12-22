# Exception

> 目的：学习笔记，会根据使用经验，持续补充ing

## 异常基本函数

异常Exception 是所有异常的基类。

+ `public Exception::construct(string $message,int $code,Exception $previous)`[构造函数](http://php.net/manual/zh/exception.construct.php)
+ `final public string Exception::getMessage ( void )` [获取异常消息内容](http://php.net/manual/zh/exception.getmessage.php)
+ `final public Exception Exception::getPrevious ( void )`[返回异常链中的前一个异常](http://php.net/manual/zh/exception.getprevious.php)
+ `final public int Exception::getCode(void)`[获取异常代码](http://php.net/manual/zh/exception.getcode.php)
+ `final public string Exception::getFile ( void )`[获取发生异常的程序文件名称](http://php.net/manual/zh/exception.getfile.php)
+ `final public int Exception::getLine ( void )`[获取发生异常的代码在文件中的行号](http://php.net/manual/zh/exception.getline.php)
+ `final public array Exception::getTrace ( void )`[获取异常追踪信息](http://php.net/manual/zh/exception.gettrace.php)
+ `final public string Exception::getTraceAsString ( void )`[以字符串类型返回异常追踪信息](http://php.net/manual/zh/exception.gettraceasstring.php)
+ `public string Exception::__toString ( void )` [将异常对象转换为字符串](http://php.net/manual/zh/exception.tostring.php)
+ `final private void Exception::__clone ( void )`[尝试克隆异常，这将导致一个致命错误。](http://php.net/manual/zh/exception.clone.php)

## 异常的子类

我们继承`Exception`这个基类，创建自己的异常类。

创建不同的异常类，是为了在`catch`的时候，可以捕捉不同的异常，并根据不同的异常类型做不同的处理。

至于创建自己异常类的标准，可以参考 **SPL 提供一系列标准异常**

**示例代码**

```
    try{
	       echo testParams('ha');
	    }catch (StringException $stringException) {
		   echo "lengthException:".$stringException->getMessage();
	    }catch (lengthException $lengthException) {
		    echo "lengthException:".$lengthException->getMessage();
	  }
	
	function testParams($param) {
    
    		if(!is_string($param)) {
    			throw new StringException("is not string");
    		}
    
    		if(strlen($param) < 5) {
    			throw new LengthException('length is not enough');
    		}
    		return $param;
    	}
    	
    	class LengthException extends Exception
        {
        
        }
        
        class StringException extends Exception
        {
        
        }
```

## 错误和异常配置

在开发环境中，我们需要显示所有可能的错误，所以在`php.ini`中的配置

```
display_errors = On #String 该选项设置是否将错误信息作为输出的一部分显示到屏幕，或者对用户隐藏而不显示
display_startup_errors = On #boolean 即使 display_errors 设置为开启, PHP 启动过程中的错误信息也不会被显示。强烈建议除了调试目的以外，将 display_startup_errors 设置为关闭。
error_reporting = -1 #boolean 即使 display_errors 设置为开启, PHP 启动过程中的错误信息也不会被显示。强烈建议除了调试目的以外，将 display_startup_errors 设置为关闭。
log_errors = On #boolean 设置是否将脚本运行的错误信息记录到服务器错误日志或者error_log之中。注意，这是与服务器相关的特定配置项。
```


生产环境中，我们要隐藏错误信息

```
display_errors = Off
display_startup_errors = Off
error_reporting = E_ALL
log_errors = On
```

[详细信息看手册](http://php.net/manual/zh/errorfunc.configuration.php)


## SPL 提供一系列标准异常

+ `BadFunctionCallException` [如果回调引用了未定义的函数，或者如果有一些参数丢失](http://php.net/manual/zh/class.badfunctioncallexception.php)
+ `BadMethodCallException` [当一个回调方法是一个未定义的方法或缺失一些参数时会抛出该异常](http://php.net/manual/zh/class.badmethodcallexception.php)
+ `DomainException` [如果值不符合定义的有效数据域，则抛出异常](http://php.net/manual/zh/class.domainexception.php)
+ `InvalidArgumentException` [如果参数不是预期类型，则抛出异常](http://php.net/manual/zh/class.invalidargumentexception.php)
+ `LengthException` [如果长度无效，则抛出异常](http://php.net/manual/zh/class.lengthexception.php)
+ `LogicException` [表示程序逻辑中的错误的异常。这种异常应该直接导致你的代码中的修复](http://php.net/manual/zh/class.logicexception.php)
+ `OutOfBoundsException` [数组：如果值不是有效的键，则抛出异常。这表示在编译时无法检测的错误](http://php.net/manual/zh/class.outofboundsexception.php)
+ `OutOfRangeException` [请求非法索引时抛出异常。这表示应在编译时检测到的错误](http://php.net/manual/zh/class.outofrangeexception.php)
+ `OverflowException` [将元素添加到完整容器时抛出异常](http://php.net/manual/zh/class.overflowexception.php)
+ `RangeException` [在程序执行期间抛出异常以指示范围错误](http://php.net/manual/zh/class.rangeexception.php)
+ `RuntimeException` [如果只能在运行时找到的错误发生，则抛出异常](http://php.net/manual/zh/class.runtimeexception.php)
+ `UnderflowException` [对空容器执行无效操作（例如删除元素）时抛出异常](http://php.net/manual/zh/class.underflowexception.php)
+ `UnexpectedValueException` [如果值与一组值不匹配，则抛出异常](http://php.net/manual/zh/class.unexpectedvalueexception.php)


## 异常和错误处理函数

+ set_exception_handler
+ restore_exception_handler

## 异常和错误的区别？

异常按理说是应用程序上的逻辑异常，可以通过合理的手段解决；

错误一般指语法错误、逻辑错误等


持续补充ing

参考：

+ [如何处理 PHP 的错误与异常（笔记）](https://segmentfault.com/a/1190000004404732#articleHeader1)
+ [PHP错误、异常汇总](https://segmentfault.com/a/1190000007182984#articleHeader17)
+ [PHP｜异常的使用，异常子类化的最佳实践](https://segmentfault.com/a/1190000005690700)
+ [PHP异常的捕获及处理](https://segmentfault.com/a/1190000006207967)
+ [PHP 错误与异常的日志记录](https://segmentfault.com/a/1190000006128054)
+ [PHP之道-Exception](http://laravel-china.github.io/php-the-right-way/#exceptions)
+ [PHP Manual Exception](http://php.net/manual/zh/language.exceptions.php#language.exceptions.finally)
