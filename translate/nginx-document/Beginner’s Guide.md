# ［nginx文档翻译系列］新手指南
原文链接：http://nginx.org/en/docs/beginners_guide.html#conf_structure
+ 启动、停止和重启加载配置
+ 配置文件结构
+ 提供静态内容
+ 设置一个简单的代理服务器
+ 设置FastCGI代理

本指南提供了一个关于nginx基本介绍并描述了一些可以用它完成的简单的任务。
我们假设nginx已经安装在读者的电脑上。如果还未安装请看“[安装nginx](http://nginx.org/en/docs/install.html)”
章节。本指南描述如何启动、停止和重启它的配置文件，解释了配置文件的结构并描述了如何设置nginx如何服务静态内容、
如何配置nginx作为一个代理服务器以及如何与FastCGI应用链接。

nginx有一个主进程和多个工作进程。主进程的目的是为了读取和评估配置并保持工作进程。
工作进程则做请求的实际处理。nginx采用基本的事件模型和操作系统以来机制来有效地分配工作进程之间的请求。
工作进程地数量可以在配置文件中定义，也可以给出一个固定值，又或者调节到CPU内核可用地数量。
参阅：[worker_processes](http://nginx.org/en/docs/ngx_core_module.html#worker_processes)

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

有关发送信号给nginx的更多信息，请参阅[Controlling nginx](http://nginx.org/en/docs/control.html)。

## 配置文件结构
nginx是由模块组成的，这些模块在配置文件中又有指定的指令。
指令被分成简单指令和块指令。简单指令包括名称和用空格分割的参数以及用来结尾的分号(;)。
一个块指令和简单指令有相同的结构，但是它使用大括号({and})来包围一系列说明来替代使用分号作为结尾。
如果一个块指令在大括号中有其他的指令，则称之为上下文（如：[events](http://nginx.org/en/docs/ngx_core_module.html#events),
 [http](http://nginx.org/en/docs/http/ngx_http_core_module.html#http),
 [server](http://nginx.org/en/docs/http/ngx_http_core_module.html#server), 
 和
 [location](http://nginx.org/en/docs/http/ngx_http_core_module.html#location)）。
 
放在配置文件最外面的指令的称之为主文，`event`,`http`指令在主文中；`server`在`http`中，
`location`在`server`中。

‘#’开头的其它行是注释。

## 提供静态内容
Web服务器一个重要的任务就是提供文件（如图像或者静态html页面）。
根据需求，你将实现一个例子，文件被本地不同的目录服务着，如`/data/www` 
包含html文件，`/data/images` 包含图片。这需要编辑配置文件，在http块中设置server块。

首先，创建`/data/www` 目录并放置index.html文件（文件中可以是任意内容）。
然后创建`/data/images`目录并放置一些图片。

接下来，打开配置文件。默认的配置文件已经包含了几个server块的例子，大多数都被注释掉了。
现在注释掉所有的块，并开始一个新的server块。
>
```
http {
    server {
    }
}
```

一般情况下，配置文件中包含多个server块，它们之间以舰艇的端口号和server name来区分。
一旦nginx决定了那个server处理请求，它测试在请求的对server块内定义的位置指令的参数头中指定的URI。
(it tests the URI specified in the request’s header against the parameters of the location directives defined inside the server block.)

将location块添加到server块中，如下：
>
```
location / {
    root /data/www;
}
```

与请求的URI相比，location块指定了“/”前缀。为了匹配请求，该URI会被添加到root指令指定的路径中，
即，到`/data/www`，在本地文件系统中组成请求文件的路径。如果有多个匹配的location块，nginx会选择前缀最长的。
上面的location块提供了最短的前缀，如果其他的location块匹配失败，这个location块就会被使用。

接下来添加第二个location块：
>
```
location /images/ {
    root /data;
}
```

它与带`/images/`的请求请求匹配。（location / ，当然也匹配，除非有更短的前缀。）
(It will be a match for requests starting with /images/ (location / also matches such requests, but has shorter prefix).)

配置文件中server块应是这样的：
>
```
server {
    location / {
        root /data/www;
    }
    location /images/ {
        root /data;
    }
}
```


这已经是一个可以工作的服务器配置文件，它监听的是80端口，可在本地通过`http://localhost/`访问。
响应带`/images/`的URI路由请求时，服务器将会从`/data/images`目录发送文件。
例如，响应 `http://localhost/images/example.png`  路由请求，nginx将会发送`/data/images/example.png`
文件。如果这个文件不存在，nginx将会发出404错误的响应。不带`/images/`的URIs请求将会映射到`/data/www`目录。
例如，为了响应`http://localhost/some/example.html`请求，nginx将会发送`/data/www/some/example.html`文件。

为了应用新的配置，如果还没开启nginx请开启，或者向nginx的主进程发送重新加载的信号，执行:

>`nginx -s reload`

```
万一没有像预期的那样工作，您可以尝试在` /usr/local/nginx/logs`或者`/var/log/nginx`目录中的
access.log和error.log文件找到原因。
```

## 设置一个简单的代理服务器
nginx最常用的功能之一就是将其设置为代理服务器，这将意味着服务器接受请求，并将请求传送给代理服务器，
然后从代理服务器取回响应，并将区徽的响应发送给客户端。

我们将会配置一个基础版本的代理服务器，它可以服务来自本地目录的图片文件请求，并将所有其它请求发送给代理服务器。
在这个例子中，所有的服务器都被定义为一个单一的nginx实例。

First, define the proxied server by adding one more server block to the nginx’s 
configuration file with the following contents:
首先，定义代理服务器通过在nginx的配置文件增加一个额外的server块，以下为添加的内容：
>
```
server {
    listen 8080;
    root /data/up1;
    location / {
    }
}
```

这是一个简单的server块，监听8080端口（此前，listen指令没有被提起是由于已经使用了标准的80端口），并将所有的请求
映射到本地文件系统的`/data/up1`目录。创建这个目录，并将index.html文件放置其中。注意root指令已经被放置在server环境中。
当location块被选中服务请求时，root指令就会被使用，当然不包括自己的root指令。
(Such root directive is used when the location block selected
for serving a request does not include own root directive.)

接下来，使用上一节服务器配置并修改它，使其变成一个代理服务器配置。在第一个location块中，放置`proxy_pass`指令与协议、
名称和参数中指定的代理服务器端口。（在我们的例子中，是http://localhost:8080）:
>
```
server {
    location / {
        proxy_pass http://localhost:8080;
    }
    location /images/ {
        root /data;
    }
}
```

我们将会修改第二个location块，它目前映射所有带`/images/`前缀的请求到`/data/images`
目录下的文件，是为了使其符合典型的文件扩展的图像请求。修改的location块应该是这样：
>
```
location ~ \.(gif|jpg|png)$ {
    root /data/images;
}
```

该参数是一个正则表达式，匹配所有.gif,.jpg,.png 结尾的路由。正则表达式应该优于～。相应的请求都会被映射到
`/data/images`目录。

当nginx选择一个location块服务一个请求时，它首先检查location指令的指定前缀，记住location最长的前缀，
然后检查正则表达式。如果有一个匹配的正则表达式，nginx会挑选location块，否则它会选择之前的。

因此代理服务器的配置文件应该是这样的:
>
```
server {
    location / {
        proxy_pass http://localhost:8080/;
    }
    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```

此服务器会筛选出以.gif,.jpg,.png 结尾的请求，并将他们映射到`/data/images`目录下(通过添加URI到root指令的参数上)，
然后通过所有其它请求到代理服务器配置上。

为了应用新的配置文件，发送reload信号到nginx，正如前面的章节所描述的那样。

还有更多的[指令](http://nginx.org/en/docs/http/ngx_http_proxy_module.html)可用于进一步配置代理链接。

## 设置FastCGI代理



