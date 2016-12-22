# Exception


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

## 异常配置

## 异常错误处理函数



参考：

+ [如何处理 PHP 的错误与异常（笔记）](https://segmentfault.com/a/1190000004404732#articleHeader1)
+ [PHP错误、异常汇总](https://segmentfault.com/a/1190000007182984#articleHeader17)
+ [PHP｜异常的使用，异常子类化的最佳实践](https://segmentfault.com/a/1190000005690700)
+ [PHP异常的捕获及处理](https://segmentfault.com/a/1190000006207967)
+ [PHP 错误与异常的日志记录](https://segmentfault.com/a/1190000006128054)
+ [PHP之道-Exception](http://laravel-china.github.io/php-the-right-way/#exceptions)
+ [PHP Manual Exception](http://php.net/manual/zh/language.exceptions.php#language.exceptions.finally)
