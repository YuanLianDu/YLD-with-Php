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

1、赋值： `set key value`
2、取值： `get key`
3、递增数字（让当前的值递增，并返回递增后的值。）： `incr key`
4、增加指定的整数：`incrby key increment`
5、减少指定的整数：`decrby key decrement`
6、增加指定浮点数：`incrbyfloat key increment`
7、向尾部追加值(向键值的末尾追加value，不存在则相当于set命令，返回值是字符串总长度)：`append key value`
8、获取字符串长度(不存在返回0)： `strlen key`
9、同时获得多个值： `mget key1 key2 …`
10、同时设置多个值： `mset key1 value1 key2 value2 …`

11、位操作:一个字节由8个二进制位组成，offset即索引从0开始。

1）、获取一个字符串类型键指定位置的二进制位的值（0或1）: `getbit key offset`
如果需要获取的二进制位的索引超过了键值的二进制位的实际长度，则默认值是0.

2）、设置字符串类型键指定位置的二进制位的值,返回值是原来的值： `setbit key offset value` 
如果要设置的位置，超过了键值的二进制位的长度，setbit命令会自动将中间的二进制位设置为0；
如果设置一个不存在的键，会将指定的二进制位的值之前的位自动赋值为0.
 
3）、获取字符串类型键中值是1的二进制位个数：`bitcount key [end] [start]`

4）、对多个字符串类型键进行位运算，并将结果存储到destkey中(opetation：and、or、xor、not): 
`bitop operation destkey key1 key2`

5）、获得指定键的第一个位值是0或者1的位置（返回结果是，偏移量，从头开始计算的，与字节数无关）：
`bitpos key1  location  [start][end]`  start end 指的是字节数

竞态条件：当一个系统或者进程的输出，依赖于不受控制时间的出现顺序或者出现时机。通俗的说，就是两个相同的操作在同一时间进行，可能造成数据错误。
原子操作：redis中的所有命令都是原子操作，即：原子操作是最小的执行单位，不会在执行过程中被其他命令插入打断。

# 2016-11-08

## 散列类型(hash)

1、定义：散列类型的键值也是一种字典结构，其存储了字段（field）和字段值的映射，但字段值只能是**字符串**。散列类型结构，类似js的对象结构。

**注意：**散列类型、列表类型、集合类型、有序集合类型，不支持**数据类型嵌套**；_比如，集合类型的每个元素只能是字符串，不能是另一个集合或者散列表_。

![hash 结构图](http://7xrgh9.com1.z0.glb.clouddn.com/16-3-5/76169138.jpg)
2、适用情况：使用对象类别和ID构成的键名，使用字段表示对象的属性，而字段值则存储属性值。

3、与mysql对比：redis散列类型，可以自由地对任何键进行字段的增删，不会造成过多的冗余，可维护性高。

4、命令：

+ 散列赋值：`hset key field value`
+ 散列，获得某个key的字段值：`hget key field`
+ 设置多个字段的值：`mset key field1 value1 field2 value2`
+ 获取过个字段的值：`mget key field1 field2 ...`
+ 获取某个键的所有字段与字段值：`hgetall key`
+ 判断字段是否存在：`hexists key field`，存在返回1，不存在返回0
+ 当字段不存在时赋值：`hsetnx key field value`
+ 字段值增加指定的数字：`hincrby key field value`，如果key不存在，会自动创建。
+ 删除字段（可删除多个）: `hdel key field1 field2 ...`
+ 获取某个key的字段：`hkeys key`
+ 获取某个key的字段值：`hvals key`
+ 获取某个key的字段数量：`hlen key`


**注意：**`hsetnx`中的nx指`if Not eXists`






