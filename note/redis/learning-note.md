启动redis：
`redis-server /usr/local/etc/redis.conf`
或
`brew services start redis`
 `brew services restart redis`

关闭redis:    `redis-cli shutdown`

测试客户端与redis的连接是否正常 `redis-cli ping`

进入交互模式 `redis-cli`

获得redis当前的配置详情：   redis>   `config get loglevel` 

修改redis当前的配置：   redis>   `config set  log level  warning`

获得符合规则的健名列表： `keys pattern(?、＊、［］、\x)`

判断一个键是否存在：`exists keyName`  存在返回1，不存在返回0

删除键  `del keyName` (可以删除一个键或多个键)，返回值是删除的键的个数

获得键值的类型  `type keyName`

# 2016-11-07
## 字符串类型：可以存储任何形式的字符串，包括二进制数据、用户的邮箱、json化的对象、甚至是一张照片。一个字符串允许的数据最大容量是512M。

1、赋值： set key value
2、取值： get key
3、递增数字（让当前的值递增，并返回递增后的值。）： incr key
4、增加指定的整数：incrby key increment
5、减少指定的整数：decrby key decrement
6、增加指定浮点数：incrbyfloat key increment
7、向尾部追加值(向键值的末尾追加value，不存在则相当于set命令，返回值是字符串总长度)：append key value
8、获取字符串长度(不存在返回0)： strlen key
9、同时获得多个值： mget key1 key2 …
10、同时设置多个值： mset key1 value1 key2 value2 …

11、位操作:一个字节由8个二进制位组成，offset即索引从0开始。

1）、获取一个字符串类型键指定位置的二进制位的值（0或1）: getbit key offset
如果需要获取的二进制位的索引超过了键值的二进制位的实际长度，则默认值是0.

2）、设置字符串类型键指定位置的二进制位的值,返回值是原来的值： setbit key offset value 
如果要设置的位置，超过了键值的二进制位的长度，setbit命令会自动将中间的二进制位设置为0；
如果设置一个不存在的键，会将指定的二进制位的值之前的位自动赋值为0.
 
3）、获取字符串类型键中值是1的二进制位个数：bitcount key [end] [start]

4）、对多个字符串类型键进行位运算，并将结果存储到destkey中(opetation：and、or、xor、not): 
bitop operation destkey key1 key2

5）、获得指定键的第一个位值是0或者1的位置（返回结果是，偏移量，从头开始计算的，与字节数无关）：
bitpos key1  location  [start][end]  start end 指的是字节数

竞态条件：
redis中的所有命令都是原子操作，即：原子操作是最小的执行单位，不会在执行过程中被其他命令插入打断。


# 2016-11-08


