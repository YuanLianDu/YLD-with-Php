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
+ 



The characteristics of FastCGI
FastCGI is independent of language.
The application of FastCGI in the process, independent of the core web server, provides a more secure than API environment. The code APIs and the core of the application of the web server are linked together, this means that in an application error in API may damage the other applications or the core server. Malicious API application code can even steal another application or the core server key.
FastCGI technical support at present: C/C++, Java language, Perl, Tcl, Python, SmallTalk, Ruby etc.. The relevant module in Apache, ISS, Lighttpd and other popular server is available.
FastCGI does not depend on any Web server architecture, so even if the server changes in technology, FastCGI is still stable.
The working principle of FastCGI
Web Server boot loader FastCGI Process Manager (IIS ISAPI or Apache Module)
FastCGI process manager initializes itself, start a number of CGI interpreter process (visible multiple php-cgi) and waits for a connection from Web Server.
When a client request arrives at the Web Server, FastCGI process manager selection and connected to a CGI interpreter. Web server CGI environment variable and the standard input is sent to the FastCGI process php-cgi.
FastCGI child process finishes the standard output and error information back to the Web Server from the same connection. When the FastCGI process is close the connection when the request processing is completed, will be the. FastCGI sub process then waits and processing from FastCGI Process Manager (running on Web Server in the next connection). In CGI mode, php-cgi then exit.
In those cases, you can imagine how slow CGI usually. Each Web request PHP must be re parsing php.ini, reload all extensions and initialize the data structure. The use of FastCGI, all of these are only in the process starts when a. An additional benefit is, persistent database connection (Persistent database connection) can work.
The deficiency of FastCGI
Because of multi process, so the ratio of CGI multi thread consumes more server memory, the PHP-CGI interpreter per process consumes 7 to 25000000000000 memory, multiply this number by 50 or 100 is a great amount of memory.
Nginx 0.8.46+PHP 5.2.14(FastCGI)The server in 30000 concurrent connections, 10 Nginx processes open consumption 150M memory (15M*10=150M), 64 php-cgi processes open consumption 1280M memory (20M*64=1280M), Add memory consumes system, Total consumption of less than 2GB memory. If the server memory., Can only open the 25 php-cgi process, So php-cgi consumption of total memory 500M. 
The above data from the Nginx 0.8.x + PHP 5.2.13 (FastCGI) to build more than ten times the Apache Web server



php-fpm
php-cgi
2、如何使用？
3、为什么使用它？
4、如何优化？

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
