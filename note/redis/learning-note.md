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
## 字符串类型：

可以存储任何形式的字符串，包括二进制数据、用户的邮箱、json化的对象、甚至是一张照片。一个字符串允许的数据最大容量是512M。

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

+ 获取一个字符串类型键指定位置的二进制位的值（0或1）: `getbit key offset`
如果需要获取的二进制位的索引超过了键值的二进制位的实际长度，则默认值是0.

+ 设置字符串类型键指定位置的二进制位的值,返回值是原来的值： `setbit key offset value` 
如果要设置的位置，超过了键值的二进制位的长度，setbit命令会自动将中间的二进制位设置为0；
如果设置一个不存在的键，会将指定的二进制位的值之前的位自动赋值为0.
 
+ 获取字符串类型键中值是1的二进制位个数：`bitcount key [end] [start]`

+ 对多个字符串类型键进行位运算，并将结果存储到destkey中(opetation：and、or、xor、not): 
`bitop operation destkey key1 key2`

+ 获得指定键的第一个位值是0或者1的位置（返回结果是，偏移量，从头开始计算的，与字节数无关）：
`bitpos key1  location  [start][end]`  start end 指的是字节数

竞态条件：当一个系统或者进程的输出，依赖于不受控制时间的出现顺序或者出现时机。通俗的说，就是两个相同的操作在同一时间进行，可能造成数据错误。
原子操作：redis中的所有命令都是原子操作，即：原子操作是最小的执行单位，不会在执行过程中被其他命令插入打断。

# 2016-11-08

## 散列类型(hash)

1、定义：散列类型的键值也是一种字典结构，其存储了字段（field）和字段值的映射，但字段值只能是**字符串**。散列类型结构，类似js的对象结构。一个散列类型**键**至多包含2^32－1个字段

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

# 2016-12-29

## 列表类型（lsit）

1、定义：可以存储一个有序的字符串列表；一个列表类型**键**最多容纳：2^32-1个元素；

比喻：像是一个排队的队伍；

2、常用操作：向列表两端添加元素；获得列表的某一个片段；

3、内部实现方式：双向链表，所以向列表两端添加元素的时间复杂度是O(1)；

4、优点：获取列表头尾的元素速度极快；

5、缺点：通过索引访问元素比较慢；

6、适用场景：

 + 比如社交网站的新鲜事，用户最关心的新鲜内容
 + 纪录日志
 + 队列
 + 比如获取文章列表并进行分页，也很方便
 
7、命令：

## 集合（set）

1、概念同高中所学的集合；一个集合类型**键**，最多可以存储2^32-1个字符串。

比喻：像一维数组

2、常用操作：向集合**添加元素**、**删除元素**、**判断某个元素是否存在**

3、内部实现原理：使用**值为空**的散列表实现的；

4、操作的时间复杂度：O(1)

5、与列表类型的对比：

|     |集合类型|列表类型｜
|----|------|-------|
| 存储内容  |  至多2^32-1个字符串 |   至多2^32-1个字符串|
| 有序性  |  no |  yes |
|  唯一性 | yes  | no  |

6、适用情景：
 
 + 文章标签

7、命令：

+ 增加元素， `sadd key member [member...]`
+ 删除元素， `srem key member [member...]`
+ 获得集合中所有的元素，`smembers key`
+ 判断元素是否在集合中，`sismember key member`
+ 多个集合，差集运算，`sdiff  key [key...]`
+ 多个集合，交集运算，`sinter  key [key...]`
+ 多个集合，并集运算，`sunion  key [key...]`
+ 获得集合中的元素个数，`scard  key`
+ 多个集合，差集运算，并保存结果，`sdiffstore destination key [key...]`
+ 多个集合，交集运算，并保存结果，`sinterstore destination key [key...]`
+ 多个集合，并集运算，并保存结果，`sunionstore destination key [key...]`
+ 随即获得结合中的元素， `srandmember key [count]`
 - count 为正数，随即获得count个不重复的元素
 - count 为负数，随即获得count个元素，有些元素可能会相同
+ 从集合中随即弹出一个元素，`spop key`



## 有序集合类型(sorted set)

1、定义：在集合类型的基础上，有序集合为集合中的**每个元素关联了一个分数**；

比喻：像二维数组

2、常用操作：删除、插入元素、判断元素是否存在、可以获得分最高（或最低）的前N个元素；

3、与列表类型对比

1）、相似点：

 + 二者都是有序的；
 + 二者都可以获得某一范围的元素；
 
2）、区别：

+ 列表类型：通过**链表**实现的，获取靠近两端的数据速度极快，而当元素增多后，访问中间的数据会较慢。适合实现**新鲜事**或**日志**，**很少访问中间元素**；
+ 有序集合类型：使用**散列表**和**跳跃表**实现的；读取位于中间的元素，速度也很快；时间复杂度：O(log(N));
+ 列表不能简单地调整某个元素的位置；有序集合可以；
+ 有序集合比列表更加**耗费内存**；

4、适用场景：

 + 按照点击数量对文章列表进行排序
 

5、命令：

+ 增加元素：向有序集合添加一个元素和元素对应的分数；若该元素存在，会用新的元素替代原来的元素；返回值，新加入到集合中的元素个数
 - 指令：`zadd key score member [score member ...]`
 - 示例1：`zadd scoreboard 89 Tom 67 Peter 100 David`;返回：`(integer) 3`
 - 示例2,分数也可以是双精度浮点数：`zadd testboard 17E+307 a`;返回：`(integer) 1`;
 - 示例3：`zadd testboard inf b`;返回：`(integer) 1`;  `inf`，正无穷；`-inf`，负无穷 ；
+ 获得元素的分数, `zscore key member`
+ 在某个范围的元素列表中，获得从小到大的排名, `zrange key start stop [withscores]`
+ 在某个范围的元素列表中，获得从大到小的排名, `zrevrange key start stop [withscores]`
+ 获得指定分数范围内的元素，`zrangebyscore key min max [withscores] [limit offset count]`
+ 增加某个元素的分数，`zincrby key increment member`
+ 获得集合中元素的数量，`zcard key`
+ 获取指定分数范围内的元素个数，`zcount key min max`
+ 删除一个或多个元素，`zrem key member [member...]`
+ 按照排名范围删除元素，从小到大排序方式，`zremrangebyrank key start stop`
+ 按照分数范围删除元素，`zremrangebyscore key min max`
+ 获得元素的排名，`zrank key member`
+ 计算有序集合的交集，`zinterstore  destination numkeys  key [key ...] [weights weight [weight...]] [aggregate sum|min|max]`
