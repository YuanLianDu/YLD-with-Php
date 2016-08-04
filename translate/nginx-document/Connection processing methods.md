# ［nginx文档翻译系列］连接处理方法
>原文链接：http://nginx.org/en/docs/events.html
如果有地方翻译的不合理，请多多指教。

nginx支持各种连接处理方法。特别方法的可用性取决于所使用的平台。
平台支持几种方法，nginx通常会自动选择最有效的方法。然而，如果需要的话，可以通过
使用指令明确的选择一个连接处理的方法。


以下连接处理方法都是支持的：

+ `select`--标准方法。支持模块在平台上自动构建，缺乏更有效的方法。`--with-select_module`和`--without-select_module`
配置参数可以用来强制启动或关闭此模块的构建。

+ `poll`--标准方法。支持模块在平台上自动构建，缺乏更有效的方法。`--with-poll_module`和`--without-poll_module`
配置参数可以用来强制启动或关闭此模块的构建。

+ `kqueue`--高效的方法可用于FreeBSD 4.1+, OpenBSD 2.9+, NetBSD 2.0, and Mac OS X。

+ `epoll`--高效的方法可用于Linux 2.6+。

>一些早期发行的如SuSE 8.2提供添加epoll支持的 2.4 kernels。

+ `/dev/poll`--高效的方法用于Solaris 7 11/99+, HP/UX 11.22+ (eventport), IRIX 6.5.15+, and Tru64 UNIX 5.1A+。
 
+ `eventport` — 事件端口, 高效的方法用于Solaris 10。