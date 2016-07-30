# 新手指南
+ 启动、停止和重启加载配置
+ 配置文件结构
+ 提供静态内容
+ 设置一个简单的代理服务器
+ 设置FastCGI代理

本指南提供了一个关于nginx基本介绍并描述了一些可以用它完成的简单的任务。
我们假设nginx已经安装在读者的电脑上。如果还未安装请看“安装nginx”章节。
本指南描述如何启动、停止和重启它的配置文件，解释了配置文件的结构并描述了如何设置nginx如何服务静态内容、
如何配置nginx作为一个代理服务器以及如何与FastCGI应用链接。

nginx有一个主进程和多个工作进程。主进程的目的是为了读取和评估配置并保持工作进程。
工作进程则做请求的实际处理。nginx采用基本的事件模型和操作系统以来机制来有效地分配工作进程之间的请求。
工作进程地数量可以在配置文件中定义，也可以给出一个固定值，又或者调节到CPU内核可用地数量。

The way nginx and its modules work is determined in the configuration file.
 By default, the configuration file is named nginx.conf and placed in the 
 directory /usr/local/nginx/conf, /etc/nginx, or /usr/local/etc/nginx.

nginx和它的模块工作方式是在配置文件中定义地。默认情况下，这个配置文件名为`nginx.conf`。
放置在`/usr/local/nginx/conf`,`/etc/nginx`或者`/usr/local/etc/nginx`目录。
