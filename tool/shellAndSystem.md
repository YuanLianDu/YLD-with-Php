## zsh
1、当`zsh: command not found: ls`等等诸如此类的问题时，说明搞乱了环境，您当前的path不包含任何公用实用程序所在的位置：

 + `PATH=/bin:/usr/bin:/usr/local/bin:${PATH}
export PATH`
+ `exec /bin/zsh` or `exec /bin/zsh` 重置zsh


## mac
1、mac 配置环境变量的地方：

+ `/etc/profile` 不建议修改这个地方，全局公有配置，无论哪个用户登录，登录时都会读取该文件
+ /etc/bashrc  系统环境变量，全局公有配置
+ ~/.bash_profie  用户级环境变量 仅登录时，读取一次
+ `echo $PATH`查看当前PATH 变量
+ `source ~/.bash_profile` 加载配置