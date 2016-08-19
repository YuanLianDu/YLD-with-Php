# PHP-fpm

## 是什么？
在理解`php-fpm`之前，我们要先搞清楚几个关键词以及他们之间的关系:`CGI` `FastCGI` `php-fpm` `php-cgi`.

**CGI:**(Common Gateway Interface)，即通用网关接口的意思，描述的是服务器和请求处理程序之间传输数据的一种标准。
所以，CGI是一种协议。CGI可用于任何语言，只要该语言具有标准的输出、输入以及环境变量。如perl、php等语言。
以nginx和php为例，我们可以理解为，这是php在与nginx服务器之间交互时，对传输数据的一种约定。

在《HTTP权威指南》书中，是这么描述的
> CGI 是一个标准接口集，Web 服务器可以用它来装载程序以响应对特定
  URL 的 HTTP 请求，并收集程序的输出数据，将其放在 HTTP 响应中回送。
  
**那CGI的原理是什么呢**
当需要请求使用网关的资源时，服务器会请辅助应用程序来处理请求（比如nginx会请php程序来处理请求）。
服务器会将辅助应用程序的数据传送给网关。然后网关会向服务器返回一条响应或者响应数据，服务器再将响应或响应数据
转发给客户端。

由此我们可以清楚两点：

+ 服务器和网关是相互独立的应用程序
+ 服务器是应用程序和网关之间的一座桥梁

具体原理如图所示：

![服务器网关应用程序机制](https://sfault-image.b0.upaiyun.com/243/072/2430725953-57b6b809dee6e_articlex)


FastCGI
php-fpm
php-cgi
2、如何使用？
3、为什么使用它？
4、如何优化？

[深入理解PHP之：Nginx 与 FPM 的工作机制](https://zhuanlan.zhihu.com/p/20694204?hmsr=toutiao.io&utm_medium=toutiao.io&utm_source=toutiao.io)
[高流量站点NGINX与PHP-fpm配置优化(译)](http://blog.xiayf.cn/2014/05/03/optimizing-nginx-and-php-fpm-for-high-traffic-sites/)
