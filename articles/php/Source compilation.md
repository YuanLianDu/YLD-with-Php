php 源码安装

```
./configure \
--prefix=/usr \
--with-config-file-path=/etc \
--enable-mbstring \
--enable-zip \
--enable-bcmath \
--enable-pcntl \
--enable-ftp \
--enable-fpm \
--enable-exif \
--enable-calendar \
--enable-sysvmsg \
--enable-sysvsem \
--enable-sysvshm \
--enable-wddx \
-disable-fileinfo \
--with-curl \
--with-mcrypt \
--with-iconv \
--with-gmp \
--with-pspell \
--with-gd \
--with-jpeg-dir=/usr \
--with-png-dir=/usr \
--with-zlib-dir=/usr \
--with-xpm-dir=/usr \
--with-freetype-dir=/usr \
--enable-gd-native-ttf \
--enable-gd-jis-conv \
--with-openssl \
--with-pdo-mysql=/usr \
--with-gettext=/usr \
--with-zlib=/usr \
--with-bz2=/usr \
--with-recode=/usr \
--with-mysqli=/usr/bin/mysql_config
```

[安装php7 常遇问题 ](http://jcutrer.com/howto/linux/how-to-compile-php7-on-ubuntu-14-04)

`php-config`  [php-config 是一个简单的命令行脚本用于获取所安装的 PHP 配置的信息。](http://php.net/manual/zh/install.pecl.php-config.php)

`php -i | grep php.ini` linux 命令行下查看php.ini位置


php.ini问价加载为空？？？？？
```
Configuration File (php.ini) Path => /etc    ／/配置文件目录
Loaded Configuration File => /etc/php.ini   ／／记载的配置文件
Scan this dir for additional .ini files => (none) //扫描此目录以获取额外的.ini文件
Additional .ini files parsed => (none) //附加的.ini文件解析
```

如果loaded为空，要重新
+ `./configure`一下，注意指明`--with-config-file-path`
+ 然后'make clean','make','make install'