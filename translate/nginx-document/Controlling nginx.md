# ［nginx文档翻译系列］ 控制nginx
>原文链接：http://nginx.org/en/docs/control.html
如果有地方翻译的不合理，请多多指教。

+ 修改配置文件（Changing Configuration）
+ 轮流日志文件（Rotating Log-files）
+ 平滑升级（Upgrading Executable on the Fly）

可以用信号控制nginx。主进程的ID默认情况下被写入`/usr/local/nginx/logs/nginx.pid`文件。
这个名字可以在配置时修改或者在`nginx.conf`文件中使用pid指令。主进程支持以下信号：
```
TERM, INT	快速关机
QUIT	    正常关机
HUP	        更改配置,紧跟着一个被改变的时区（仅适用于FreeBSD和Linux） ，
            用新的配置开始一个新的工作进程，
            正常关掉旧的工作进程。
USR1	    重新打开日志文件
USR2	    升级可执行文件
WINCH	    工作进程正常关机
```

个人工作进程也可以使用信号控制，尽管并不是必须的。支持的信号有：
```
TERM, INT	快速关机
QUIT	    正常关机
USR1	    重新打开日志文件
WINCH	    调试异常终止（要求debug_points 可用）
```

## 修改配置文件
为了让nginx重读配置文件，一个HUP信号应该被发送到主进程。主进程首先检查语法的有效性，然后试图应用新的配置，即
打开日志文件和新的监听套接字。如果失败，它会回滚变化的地方，并继续使用旧的配置。如果成功了，它会开启新的工作进程，
并向旧的进程发送正常关机的消息。旧的工作进程关闭监听的套接字并继续服务旧的客户端。当服务完所有的客户端，
旧的工作进程会关闭。

让我们通过示例来说明。假设nginx是运行在FreeBSD 4.x 上的，这个命令是：
>`ps axw -o pid,ppid,user,%cpu,vsz,wchan,command | egrep '(nginx|PID)'`

产生以下输出：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
33126     1 root     0.0  1148 pause  nginx: master process /usr/local/nginx/sbin/nginx
33127 33126 nobody   0.0  1380 kqread nginx: worker process (nginx)
33128 33126 nobody   0.0  1364 kqread nginx: worker process (nginx)
33129 33126 nobody   0.0  1364 kqread nginx: worker process (nginx)
```

如果HUP被传达到主进程，输出变成：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
33126     1 root     0.0  1164 pause  nginx: master process /usr/local/nginx/sbin/nginx
33129 33126 nobody   0.0  1380 kqread nginx: worker process is shutting down (nginx)
33134 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
33135 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
33136 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
```

旧的工作进程之中有一个ID为333129的仍旧在工作。一段时间后退出：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
33126     1 root     0.0  1164 pause  nginx: master process /usr/local/nginx/sbin/nginx
33134 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
33135 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
33136 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
```

## 轮流日志文件(Rotating Log-files)
为了轮流日志文件，它们首先需要重命名。之后USR1信号应该被发送到主进程。
主进程将重新打开当前所有的日志文件，并为它们分配工作进程正在运行下的一个非特权用户作为拥有者。
在重新打开成功之后，主进程会关闭所有打开的文件，并向工作进程发送消息请求它们重新打开文件。
工作进程也会立即打开新的文件并关闭旧的文件。因此，旧文件几乎可立即用于post processing，比如压缩。

## 平滑升级（Upgrading Executable on the Fly）
为了平滑升级服务器，首先新的可执行文件应放置在旧文件的地方(the new executable file should be put in place of an old file first.)。
在USR2信号被发送到主进程之后。主进程首先在新文件重命名文件中的ID带着`.oldbin`后缀，比如`/usr/local/nginx/logs/nginx.pid.oldbin`，
然后启动新的可执行文件进而轮流启动新的工作进程:
>
```
 PID  PPID USER      %CPU  VSZ WCHAN  COMMAND
33126     1 root     0.0  1164 pause  nginx: master process /usr/local/nginx/sbin/nginx
33134 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
33135 33126 nobody   0.0  1380 kqread nginx: worker process (nginx)
33136 33126 nobody   0.0  1368 kqread nginx: worker process (nginx)
36264 33126 root     0.0  1148 pause  nginx: master process /usr/local/nginx/sbin/nginx
36265 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36266 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36267 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
```

在这之后所有的工作进程（旧的和新的）都继续接受请求。如果WINCH信号传送到了第一个主进程，它会发送消息到它的工作进程
，要求它们正常关机，然后它们将会退出：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
33126     1 root     0.0  1164 pause  nginx: master process /usr/local/nginx/sbin/nginx
33135 33126 nobody   0.0  1380 kqread nginx: worker process is shutting down (nginx)
36264 33126 root     0.0  1148 pause  nginx: master process /usr/local/nginx/sbin/nginx
36265 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36266 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36267 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
```

一段时间之后，只有新的工作进程会处请求：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
33126     1 root     0.0  1164 pause  nginx: master process /usr/local/nginx/sbin/nginx
36264 33126 root     0.0  1148 pause  nginx: master process /usr/local/nginx/sbin/nginx
36265 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36266 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36267 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
```

应该注意的是旧的主进程并没有关闭它的监听套接字，而且在需要的情况下，它可以被用来再一次启动它的工作进程。
如果处于某些原因，新的可执行文件工作不能被接受，可以做以下之一：

+ 发送HUP信号给旧的主进程。旧的主进程会启动新的工作进程在没有重读配置文件的情况下。之后，通过
发送QUIT信号给新的主进程，所有新的进程都可以正常关闭。
+ 发送TERM信号给新的主进程。然后它会发送消息给它的工作进程请求它们立即退出，它们几乎都立即退出。
（如果新的进程由于某些原因没有退出，应该把KILL信号发送给它们，强制他们退出。）当新的主进程退出时，旧进程会自动地启动
它新的进程。

如果新的主进程退出，旧的主进程会丢弃文件中`.oldbin`后缀文件名的进程ID。

如果升级成功，旧的主进程应该发送QUIT信号，只有新的进程会存在：
>
```
PID    PPID USER    %CPU   VSZ WCHAN  COMMAND
36264     1 root     0.0  1148 pause  nginx: master process /usr/local/nginx/sbin/nginx
36265 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36266 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
36267 36264 nobody   0.0  1364 kqread nginx: worker process (nginx)
```

