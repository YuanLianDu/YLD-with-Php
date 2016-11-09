
  
连接memcached服务器： `telnet HOST PORT` 指定主机ip和端口来连接 Memcached 服务  `telnet 127.0.0.1 11211`

#### set命令 

```
set key flags expiretime bytes [noreply] 
value 
```

+ key: 键值 key-value 结构中的 key，用于查找缓存值。
+ flags: 可以包括键值对的整型参数，客户机使用它存储关于键值对的额外信息。
+ expiretime: 在缓存中保存键值对的时间长度（以秒为单位，0 表示永远）。
+ bytes: 在缓存中存储的字节数。
+ noreply（可选）： 该参数告知服务器不需要返回数据
+ value：存储的值（始终位于第二行）（可直接理解为key-value结构中的value）

示例：

```
set runoob 0 900 9
memcached
STORED

get runoob
VALUE runoob 0 9
memcached
END
```

#### add 命令

使用方法同set一样，如果 add 的 key 已经存在，则不会更新数据，之前的值将仍然保持相同，并且获得响应是 NOT_STORED。
```
add key flags exptime bytes [noreply]
value
```

#### replace 命令

取代一个key的值，使用方法同上

#### append 

在已有的key值后面追加一个值，使用方法同上。

#### prepend 

在已有的key值前面追加一个值，使用方法同上。

#### incr/decr

对已存的key－的value值进行增加减少

`incr/decr key   increment/decrement _value`


## Memcached 统计命令

#### `stats`

```
pid：	memcache服务器进程ID
uptime：服务器已运行秒数
time：服务器当前Unix时间戳
version：memcache版本
pointer_size：操作系统指针大小
rusage_user：进程累计用户时间
rusage_system：进程累计系统时间
curr_connections：当前连接数量
total_connections：Memcached运行以来连接总数
connection_structures：Memcached分配的连接结构数量
cmd_get：get命令请求次数
cmd_set：set命令请求次数
cmd_flush：flush命令请求次数
get_hits：get命令命中次数
get_misses：get命令未命中次数
delete_misses：delete命令未命中次数
delete_hits：delete命令命中次数
incr_misses：incr命令未命中次数
incr_hits：incr命令命中次数
decr_misses：decr命令未命中次数
decr_hits：decr命令命中次数
cas_misses：cas命令未命中次数
cas_hits：cas命令命中次数
cas_badval：使用擦拭次数
auth_cmds：认证命令处理的次数
auth_errors：认证失败数目
bytes_read：读取总字节数
bytes_written：发送总字节数
limit_maxbytes：分配的内存总大小（字节）
accepting_conns：服务器是否达到过最大连接（0/1）
listen_disabled_num：失效的监听数
threads：当前线程数
conn_yields：连接操作主动放弃数目
bytes：当前存储占用的字节数
curr_items：当前存储的数据总数
total_items：启动以来存储的数据总数
evictions：LRU释放的对象数目
reclaimed：已过期的数据条目来存储新数据的数目
```