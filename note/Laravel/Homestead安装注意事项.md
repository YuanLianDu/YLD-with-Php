#Homestead安装
## 1、准备工作
+ 下载安装[virtualbox](https://www.virtualbox.org/wiki/Downloads)或者vmware，但是vmware是收费的。
+ 下载安装[vagrant](https://www.vagrantup.com/downloads.html)
+ **注意windows系统，需要通过bios来开启硬件虚拟化设备**

## 2、下载homestead盒子
### 1） 使用vagrant下载盒子
+ 下载homestead盒子,执行`vagrant box add laravel/homestead`
+ 下载此盒子经常会因为网络原因而中断，再执行此命令时会出现![错误](./_image/B647504F-7184-49D7-B2B3-7C72AE29C9FD.png)执行`vagrant box add laravel/homestead -c`，它会清除之前下载的缓存。


### 2）使用链接
使用vagrant命令添加box，是不支持断点下载的，所以经常会因为网络原因断开而导致下载失败。所以，我们可以通过第三方工具下载。

如何获得下载地址呢？执行`vagrant box add laravel/homestead`后，选择完虚拟服务提供者之后，就会出现链接。可参考途中绿色部分。![下载地址](/Users/yuan/Desktop/download url.png)

因为我的电脑已经安装了homestead，所以下面的图是我以其他的盒子为例显示的。

### 3）下载别人已经下载好的盒子
+ 当我尝试这个方法时，下载的盒子出现了问题，所以没有成功。但是可以参考这篇文章<https://phphub.org/topics/2090>
+ 后面有时间，我也会将我的盒子上传分享出来，以供大家尝试。

## 3、下载完之后的配置


###1）通过克隆homestead仓库来配置homstead
使用vagrant添加完box，一般我们是在初始化之后在相应的vagrantfile中做配置的。克隆homestead仓库是因为它替我们做了一些工作，让配置部分的工作更简单。接下来，我会以我本地配置的laravel项目为例。

+ 克隆homestead `git clone https://github.com/laravel/homestead.git Homestead`
+ 进入Homestead目录，执行`bash init.sh`，生成Homestead.yaml配置文件。
+ 进入~/.homestead目录，即可看到Homestead.yaml配置文件。
+ 分享一下我的Homestead.yaml相关配置， `provider`表示的是那个vagrant提供者；`keys`为ssh key路径，如果没有ssh key则需要生成公共秘钥；`floders`是配置本机与虚拟机中的共享文件夹的；


```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: /Users/yuan/PhpstormProjects
      to: /www

sites:
    - map: learn.laravel.com
      to: /www/laravel/public

databases:
    - laravel

# blackfire:
#     - id: foo
#       token: bar
#       client-id: foo
#       client-token: bar

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp
```
+ 打开hosts文件进行配置本地域名`192.168.10.10 learn.laravel.com`,即可访问laravel这个项目
+ homestead默认的虚拟机的mysql用户名：root，密码：secret，host:127.0.0.1；如果需要通过ssh链接数据库，ssh host:127.0.0.1，用户名：vagrant，密码：vagrant，ssh port：2201.
+ **目前homestead仓库的分支php-7已经不存在，而且目前homstead仓库都已支持php7.所以不需要再使用这个命令克隆或升级到php7`git clone -b php-7 https://github.com/laravel/homestead.git Homestead`**

### 2)使用vagrant传统的方法
+ 创建一个开发目录，例如homestead
+ 进入homstead目录，`vagrant init homestead`
+ 同时homestead目录中会有`vagrantfile`文件，参考[vagrant文档](https://www.vagrantup.com/docs/)配置即可
+ 执行`vagrant up`启动
+ 执行`vagrant ssh`进入

## 参考文章：
+ 使用 Vagrant 打造跨平台开发环境 <https://segmentfault.com/a/1190000000264347>
+ Homestead 安装需要知道的一些信息 <https://phphub.org/topics/2090>
+ 上手并过渡到PHP7（1）——基于Homestead的PHP7和XDdebug环境 <https://segmentfault.com/a/1190000004148696>


