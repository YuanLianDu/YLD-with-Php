# 新手指南
+ 启动、停止和重启加载配置
+ 配置文件结构
+ 提供静态内容
+ 设置一个简单的代理服务器
+ 设置FastCGI代理

本指南提供了一个关于nginx基本介绍并描述了一些可以用它完成的简单的任务。
我们假设nginx已经安装在读者的电脑上。如果还未安装请看“(http://nginx.org/en/docs/install.html)[安装nginx]”
章节。本指南描述如何启动、停止和重启它的配置文件，解释了配置文件的结构并描述了如何设置nginx如何服务静态内容、
如何配置nginx作为一个代理服务器以及如何与FastCGI应用链接。

nginx有一个主进程和多个工作进程。主进程的目的是为了读取和评估配置并保持工作进程。
工作进程则做请求的实际处理。nginx采用基本的事件模型和操作系统以来机制来有效地分配工作进程之间的请求。
工作进程地数量可以在配置文件中定义，也可以给出一个固定值，又或者调节到CPU内核可用地数量。
参阅：(http://nginx.org/en/docs/ngx_core_module.html#worker_processes)[worker_processes]

nginx和它的模块工作方式是在配置文件中定义的。默认情况下，这个配置文件名为`nginx.conf`。
放置在`/usr/local/nginx/conf`,`/etc/nginx`或者`/usr/local/etc/nginx`目录。


## 启动、停止和重启加载配置
要启动nginx，运行可执行文件。一旦nginx被启动，它可以通过调用`-s`参数来执行控制。使用一下命令：
>`nginx -s signal`

signal可以是以下之一：

+ stop — 快速关机
+ quit — 正常关机
+ reload — 重新加载配置文件
+ reopen — 重新打开日志文件

例如，要停止nginx等待工作进程完成服务当前请求的进程，可以执行以下命令：
>`nginx -s quit`

```
执行此命令的用户应与启动nginx的用户一致。
```

在配置文件中的修改是不会被应用的，直到重新加载的命令被传送到nginx或者重新启动。
重新加载配置，执行:
>`nginx -s reload`

一旦主进程接收到信号重新加载配置文件，它会检查新配置文件语法的合法性并尝试应用。
如果成功，主进程会开启新的工作进程，并发送消息告诉旧的工作进程，请求他们快速停止。
反之，主进程会回滚配置文件修改的部分，继续使用旧的配置。旧的工作进程接收到快速停止的命令，
会停止接受新的连接请求，它会继续服务当前的请求直到请求被服务结束。在那之后，旧的进程会退出。


一个信号也可以在Unix工具的帮助下传送到nginx进程，如`kill`工具。在这种情况下，会直接把信号
传送给所指定的进程ID的进程。nginx主进程的进程ID被写入，默认情况下，nginx.pid在`/usr/local/nginx/logs`
或者`/var/run`目录下。比如，如果主进程ID是1628，要传送`QUIT`信号来停止nginx，执行：
>`kill -s QUIT 1628`


为了获取正在运行的nginx进程列表，可以使用ps工具，比如，以下方式：
>`ps -ax | grep nginx`

有关发送信号给nginx的更多信息，请参阅(http://nginx.org/en/docs/control.html)[Controlling nginx]。
