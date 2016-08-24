# 细说PHP-fpm

## 是什么？
> 在理解`php-fpm`之前，我们要先搞清楚几个关键词以及他们之间的关系:`CGI` `FastCGI` `php-fpm` `php-cgi`.

**CGI:**(Common Gateway Interface)，即通用网关接口的意思，描述的是服务器和请求处理程序之间传输数据的一种标准。
所以，`CGI`是一种协议。`CGI`可用于任何语言，只要该语言具有标准的输出、输入以及环境变量。如perl、php等语言。
以nginx和php为例，我们可以理解为，这是php在与nginx服务器之间交互时，对传输数据的一种约定。

在《HTTP权威指南》书中，是这么描述的
> `CGI`是一个标准接口集，Web 服务器可以用它来装载程序以响应对特定
  URL 的 HTTP 请求，并收集程序的输出数据，将其放在 HTTP 响应中回送。
  
**那CGI的原理是什么呢**

当需要请求使用网关的资源时，服务器会请辅助应用程序来处理请求（比如nginx会请php程序来处理请求）。
服务器会将辅助应用程序的数据传送给网关。然后网关会向服务器返回一条响应或者响应数据，服务器再将响应或响应数据转发给客户端。

由此我们可以清楚两点：

+ 服务器和网关是相互独立的应用程序
+ 服务器是应用程序和网关之间的一座桥梁

具体原理如图所示：

![服务器网关应用程序机制](https://sfault-image.b0.upaiyun.com/243/072/2430725953-57b6b809dee6e_articlex)

由此，我们可知`CGI`有一个致命的弱点，**即应用程序的每次请求，都要引发一个全新的进程**。所以，服务器和网关之间的分离会造成性能的
耗费，会限制使用`CGI`的服务器的性能，并且会加重服务端机器资源的负担。

好啦，重角要登场了。后来为了解决这个问题，出现了`FastCGI`，也就是快速的`CGI`。
接下来，我们再详细的了解下`FastCGI`。

**FastCGI:**(Fast Common Gateway Interface),即快速通用网关接口，是一种让交互程序与Web服务器通信的协议。它是`CGI`的增强版本
`FastCGI`致力于减少网页服务器与CGI程序之间互动的开销，从而使服务器可以同时处理更多的网页请求。

以上来自维基百科，我们可以由此了解到，`FastCGI`，**同`CGI`一样，也是一种协议，**只不过它是`CGI`的增强版本。

**那`FastCGI`是如何增强性能的呢？**
`FastCGI`接口模拟了`CGI`，但`FastCGI`是作为持久守护进程运行的，消除了为每个请求建立或拆除新进程所带来的性能损耗。也就是允许，一个进程内可以处理多个请求。
也就说CGI解释器保持在内存中，并接受了`FastCGI`进程管理和调度，所以它可以提供更好的性能，可扩展性，故障切换等特点

**FastCGI的特点**

+ FastCGI与语言无关
+ FastCGI应用在进程中，独立于核心网络服务器，提供了一个比API环境更安全的环境。 APIs的代码和web服务器的应用的核心是
紧紧关联的。这也就意味着在API应用程序的错误可能会损坏其它应用程序或核心服务器。恶意API应用程序代码甚至可以窃取另一个应用程序或核心服务器密钥。
+ FastCGI技术摸钱支持PHP,C/C++, Java language, Perl, Tcl, Python, SmallTalk, Ruby etc.. 它在Apache, ISS, Lighttpd和其他流行的
服务器中的相关模块都是可以使用的。FastCGI不依赖于任何服务器体系结构，所以即使服务器在技术上改变了，FastCGI还是稳定的

**FastCGI的工作原理**

+ Web Server 启动时载入FastCGI进程管理器 (IIS ISAPI 或Apache Module)
+ FastCGI进程管理器首先初始化自己，启动一批CGI解释器进程（可见多个php-cgi），然后等待来自Web Server的连接。
+ 当Web Server中的一个客户端请求达到时， FastCGI进程管理器会选择并连接一个CGI解释器。Web server的CGI环境变量和标准输入会被送达FastCGI进程的php-cgi。
+ FastCGI子进程从同一连接完成返还给Web Server的标准输出和错误信息。当请求进程完成后，FastCGI进程会关闭此连接。FastCGI会等待并出来来自FastCGI进程管理器（运行在Web Server中的）的下一个连接。
在CGI模式，php-cgi然后会退出。

**FastCGI的不足**
因为是多进程，所以比CGI多线程消耗更多的服务器内存，PHP-CGI解释器每进程消耗7至25兆内存，将这个数字乘以50或100就是很大的内存数。
Nginx 0.8.46+PHP 5.2.14(FastCGI)服务器在3万并发连接下，开启的10个Nginx进程消耗150M内存（15M*10=150M），开启的64个php-cgi进程消耗1280M内存（20M*64=1280M），加上系统自身消耗的内存，总共消耗不到2GB内存。
如果服务器内存较小，完全可以只开启25个php-cgi进程，这样php-cgi消耗的总内存数才500M。
[上面的数据摘自Nginx 0.8.x + PHP 5.2.13(FastCGI)搭建胜过Apache十倍的Web服务器(第6版)](http://zyan.cc/nginx_php_v6/)

**PHP-CGI**:　PHP-CGI是PHP自带的FastCGI管理器。

**PHP-CGI的不足**

+ php-cgi变更php.ini配置后需重启php-cgi才能让新的php-ini生效，不可以平滑重启
+ 直接杀死php-cgi进程,php就不能运行了。(PHP-FPM和Spawn-FCGI就没有这个问题,守护进程会平滑从新生成新的子进程。）

**php-fpm**

+ PHP-FPM是一个PHP FastCGI管理器，是只用于PHP的,可以在 http://php-fpm.org/download下载得到.
+ PHP-FPM其实是PHP源代码的一个补丁，旨在将FastCGI进程管理整合进PHP包中。必须将它patch到你的PHP源代码中，在编译安装PHP后才可以使用。
+ 现在我们可以在最新的PHP 5.3.2的源码树里下载得到直接整合了PHP-FPM的分支，据说下个版本会融合进PHP的主分支去。相对Spawn-FCGI，PHP-FPM在CPU和内存方面的控制都更胜一筹，而且前者很容易崩溃，必须用crontab进行监控，而PHP-FPM则没有这种烦恼。
PHP5.3.3已经集成php-fpm了，不再是第三方的包了。PHP-FPM提供了更好的PHP进程管理方式，可以有效控制内存和进程、可以平滑重载PHP配置，比spawn-fcgi具有更多有点，所以被PHP官方收录了。在./configure的时候带 –enable-fpm参数即可开启PHP-FPM。

本文后半部分主要参考这片文章：

+ [中文版：什么是CGI、FastCGI、PHP-CGI、PHP-FPM、Spawn-FCGI？](http://www.mike.org.cn/articles/what-is-cgi-fastcgi-php-fpm-spawn-fcgi/)
+ [英文版：PHP CGI, FastCGI, PHP-CGI and PHP-FPM](http://www.programering.com/a/MDOwADMwATA.html)

后续系列有时间会持续更新，[大家可以在这里分享关于这个主题的相关文章，供大家一起学习，有需要整理的地方，我也会整理出来](https://github.com/YuanLianDu/YLD-with-Php/issues/3)

参考文章列表：

+ [深入理解PHP之：Nginx 与 FPM 的工作机制](https://zhuanlan.zhihu.com/p/20694204?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
+ [高流量站点NGINX与PHP-fpm配置优化(译)](http://blog.xiayf.cn/2014/05/03/optimizing-nginx-and-php-fpm-for-high-traffic-sites/)
+ [php中fastcgi和php-fpm是什么东西](https://www.zybuluo.com/phper/note/50231)
+ [Q:搞不清FastCgi与PHP-fpm之间是个什么样的关系](https://segmentfault.com/q/1010000000256516)
+ [什么是CGI、FastCGI、PHP-CGI、PHP-FPM、Spawn-FCGI？](http://www.mike.org.cn/articles/what-is-cgi-fastcgi-php-fpm-spawn-fcgi/)
+ [PHP CGI, FastCGI, PHP-CGI and PHP-FPM](http://www.programering.com/a/MDOwADMwATA.html)
+ [Django FastCGI](https://www.nginx.com/resources/wiki/start/topics/examples/djangofastcgi/)
+ [服务器程序源代码分析之二：php-fpm](http://m.lutaf.com/218.htm)
+ [ Nginx工作原理和优化、漏洞](http://blog.csdn.net/hguisu/article/details/8930668)
+ [深入理解Zend SAPIs(Zend SAPI Internals)](http://www.laruence.com/2008/08/12/180.html)
