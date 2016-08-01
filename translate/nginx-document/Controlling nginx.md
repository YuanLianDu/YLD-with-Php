# ［nginx文档翻译系列］ 控制nginx
原文链接：http://nginx.org/en/docs/control.html

+ Changing Configuration修改配置文件
+ Rotating Log-files玩转日志文件
+ Upgrading Executable on the Fly快速的执行升级

可以用信号控制nginx。主进程的ID默认情况下被写入`/usr/local/nginx/logs/nginx.pid`文件。
这个名字可以在配置时修改或者在`nginx.conf`文件中使用pid指令。主进程支持以下信号：
```
TERM, INT	fast shutdown
QUIT	    graceful shutdown
HUP	        changing configuration, 
            keeping up with a changed time zone (only for FreeBSD and Linux), 
            starting new worker processes with a new configuration, 
            graceful shutdown of old worker processes
USR1	    re-opening log files
USR2	    upgrading an executable file
WINCH	    graceful shutdown of worker processes
```