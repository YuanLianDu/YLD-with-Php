# Learning diary
## laravel
### 1、laravel安装
* composer安装：<https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx>
* laravel安装：`composer global require "laravel/installer=~1.1" `
* 终端执行：`export PATH=~/.composer/vendor/bin:$PATH`<br/>
			确保 PATH 环境变量已经添加了 ~/.composer/vendor/bin 目录
			
			
* homestead `export PATH="~/.config/composer/vendor/bin:$PATH"`
* 新建项目，若状态码为500，赋予权限
	* `sudo chmod -R 777 storage`

### 2、artisan命令
`php artisan make:model model-name`
`php artisan make:controller Admin/AdminHomeController `
`php artisan migrate`
 
 
### 3、查询
`groupBy`可以去重,根据某个字段<br/>
`distinct`可以去重，根据id<br/>
`whereRaw`如果没办法使用流畅接口产生出查询语句，也可以使用 whereRaw 方法：
`$users = User::whereRaw('age > ? and votes = 100', [25])->get();`<br/>
`raw`加原声语句<br/>
`whereNotNull`<br/>
`whereIn`<br/>

### 4、队列
#### **1.环境配置**

1. vagrant中安装redis（cmd运行）
 
	下载，解压，编译:
	
	```
  	$ wget http://download.redis.io/releases/redis-3.0.5.tar.gz  
  	$ tar xzf redis-3.0.5.tar.gz  
  	$ cd redis-3.0.5  
  	$ make
  	```	  
  	二进制文件是编译完成后在src目录下. 运行如下:
  	
  	```
  	$ src/redis-server
  	```
  	You can interact with Redis using the built-in client:
  	
  	```
  	$ src/redis-cli
	redis> set foo bar
	OK
	redis> get foo
	"bar"
  	```
	
2. mac本地安装nginx(先安装brew，通过brew安装nginx)

	安装brew
	`ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"`
	
	安装成功后(最好翻墙)
	
	`brew install nginx`

3. 申请微信测试公众号：	将爱逸站账号内的URL和Token填入；点击网页账号－》网页授权获取用户基本信息后的**修改**按钮，添加`app.dev.i-yizhan.com`

4. 修改 .env <br/>
	`APP_URL`=`本地URL`<br/>或线上测试URL:`APP_URL=http://app.dev.i-yizhan.com`<br/>
`APP_APPID`=`wx67962667ddad0a4b`(自己的微信测试号信息)<br/>
`APP_SECRET`=`d4624c36b6795d1d99dcf0547af5443d`（自己的微信号测试信息)<br/>
`REDIS_HOST=127.0.0.1`<br/>
`REDIS_PORT=6379`<br/>
`REDIS_PASSWORD=`<br/>

#### **2.laravel 5.1 队列命令**


```
php artisan queue:table
php artisan migrate
```
`php artisan make:job SendReminderEmail --queued`借由下面 Artisan 命令产生一个可使用队列的命令<br/>
`php artisan queue:listen`开始队列监听
`php artisan queue:listen connection`指定特定队列连接让监听器使用<br/>

#### **3.测试具体操作（直接在本地测试）**
1. 链接远程服务器（本地上）：
`ssh -N -C -R 4000:127.0.0.1:7000 www@121.43.234.128` 
密码：devwww<br/>或
`ssh -N -C -R 4000:127.0.0.1:7000 root@121.43.234.128`密码：Iyzdev2015（连接www）
2. 启动vagrant，启动redis`redis-server /etc/redis/redis.conf `
3. 队列监听：php artisan queue:listen（vagrant）
4. 查看数据库数据信息变化； 
5. `netstat -antp`可以列出端口占用情况（新建远程连接的terminal）
6. `kill -9 xxxx`杀死某段进程 xxx为id号（vagrant执行）





## Php
### 1、上传／下载
### 2、Reflection
1. 



## Phpstorm 快捷键（Mac）


## mysql workBench
### connection
1. 为什么 MySQL Hostname 是127.0.0.1，不是192.168.33.10？
![images](/Users/yuan/Documents/IT-文/mysql-workbench/connection.png)


## 插件 Repository 模式 

### 学习地址：<http://laravelacademy.org/post/3063.html>
### 插件地址：<https://github.com/Bosnadev/Repositories>
