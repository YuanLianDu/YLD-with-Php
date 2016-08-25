# 数据库引擎(MySQL 5.7 Reference Manual)

## 译－存储引擎的选择
[Chapter 16 Alternative Storage Engines](http://dev.mysql.com/doc/refman/5.7/en/storage-engines.html)

存储引擎是MySQL的组件，是用来为不同表类型处理SQL操作的。**InnoDB**是目前默认的也是最通用的存储引擎。**Oracle**也建议使用它
除了专门的使用案例。在MySQL中5.7 CREATE TABLE语句默认创建InnoDB表。

MySQL服务器采用了插件式存储引擎架构，是为了确保存储引擎可以从正在运行的MySQL服务器上被装入和卸载。

为了确定你的机器支持哪种存储引擎，使用` SHOW ENGINES `语句。在支持列中的值表示引擎是否可以使用。
值为YES，NO，或DEFAULT分别表示一个引擎是可用的，不可用，或可用与目前设置为默认存储引擎。

**使用此命令前先登陆mysql；以下是我的机器显示结果，非官方**
```
mysql> SHOW ENGINES\G
*************************** 1. row ***************************
      Engine: InnoDB
     Support: DEFAULT
     Comment: Supports transactions, row-level locking, and foreign keys
Transactions: YES
          XA: YES
  Savepoints: YES
*************************** 2. row ***************************
      Engine: MRG_MYISAM
     Support: YES
     Comment: Collection of identical MyISAM tables
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 3. row ***************************
      Engine: MEMORY
     Support: YES
     Comment: Hash based, stored in memory, useful for temporary tables
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 4. row ***************************
      Engine: BLACKHOLE
     Support: YES
     Comment: /dev/null storage engine (anything you write to it disappears)
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 5. row ***************************
      Engine: MyISAM
     Support: YES
     Comment: MyISAM storage engine
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 6. row ***************************
      Engine: CSV
     Support: YES
     Comment: CSV storage engine
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 7. row ***************************
      Engine: ARCHIVE
     Support: YES
     Comment: Archive storage engine
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 8. row ***************************
      Engine: PERFORMANCE_SCHEMA
     Support: YES
     Comment: Performance Schema
Transactions: NO
          XA: NO
  Savepoints: NO
*************************** 9. row ***************************
      Engine: FEDERATED
     Support: NO
     Comment: Federated MySQL storage engine
Transactions: NULL
          XA: NULL
  Savepoints: NULL
9 rows in set (0.00 sec)
```

本章介绍了专用的MySQL存储引擎的使用案例。它不包括默认的InnoDB存储引擎或覆盖在第15章NDB存储引擎，
InnoDB存储引擎，以及第19章，MySQL集群7.5 NDB。对于高级用户，
本章还包含了插件式存储引擎架构的说明（见第16.11，“MySQL存储引擎架构概述”）。

有关商业MySQL服务器的二进制文件提供存储引擎的支持信息，请参阅MySQL企业版服务器5.7，在MySQL的网站。
可用的存储引擎可能取决于其企业服务器版所使用。

为了解答常见关于MySQL存储引擎的问题，请参见A.2“的MySQL 5.7 FAQ：存储引擎”。

**MySQL的5.7支持的存储引擎**

+ InnoDB:MySQL 5.7默认的存储引擎。InnoDB的是MySQL事务安全（ACID兼容）存储引擎，具有提交，回滚和崩溃恢复功能来保护用户数据。
InnoDB的行级锁（而不是升级到粗粒度锁）和Oracle风格一致的非锁定读取增加了多用户的并发性和性能。InnoDB在聚集索引中存储用户数据，以减少基于主键常用的查询I/O。
为了保持数据的完整性，InnoDB也支持外键参照完整性约束。有关InnoDB的更多信息，请参见第15章，InnoDB存储引擎。
+ MyISAM:这些表有一个小的足迹。表级锁限制在读/写工作负载的性能，所以它经常在只读或读 - 主要是在Web和数据仓库工作负载配置使用。 
+ Memory: 存储所有的数据在`RAM`中，是为了在环境中快速访问，这个要求非关键数据的快速查找。这个引擎的前身为HEAP引擎。使用它的例子正在下降。
与它的缓冲池存储器区域InnoDB提供一个通用和耐用的方式保持大部分或全部数据在内存中，并且NDBCLUSTER提供巨大分布式数据集快速键值查找。
+ CSV:它的表是逗号分割值的text文件。CSV表格让你可以导入或转储CSV格式的数据，用脚本和应用程序读取和写入相同的格式进行数据交换。
由于CSV表不被索引，通常保存在InnoDB表中的数据在正常运行期间，只有在进口或出口阶段使用CSV表。
+ Archive: 这些紧凑，没有索引的表意用于存储和检索大量很少引用的历史，归档，或安全审计信息。
+ Blackhole: 黑洞存储引擎接受但不存储数据，类似于Unix的/dev/null的设备。查询总是返回一个空集。这些表可以在DML语句被发送到从服务器复制配置中使用，但主服务器不保留它自己的数据副本。
+ NDB (也称为NDBCLUSTER):该集群数据库引擎是特别适合于那些需要运行时间和可用性的最高程度的应用。
+ Merge: 启用一个MySQL DBA或开发人员进行逻辑分组的一系列等同的MyISAM表，并引用它们作为一个对象。适合VLDB环境，如数据仓库。
+ Federated:提供一种能力，可以通过连接隔离的MySQL服务器来从众多的物理服务器中创建一个逻辑数据库。十分适合于分布式环境或数据集市环境。
+ Example: 这个引擎服务器在MySQL源码中作为一个例子，是介绍如何开始着手写新的存储引擎。它主要针对有兴趣的开发者。存储引擎是一个“存根”，什么也不做。
你可以使用这个引擎创建表，但是不会有数据可以存储进去或者从中读取到数据。

并不限制你只是用一个存储引擎在一个完整的服务器或者架构中。你可以指定任意一个表所使用的存储引擎。比如，一个应用可能使用的最多的是InnoDB表，
一个CSV表数据导出到一个电子表格和临时工作区的几个MEMORY表。

**选择一个存储引擎**
MySQL多种多样的存储引擎是为了不同的情况所设计的。下面这个表格提供了一个关于MySQL一些存储引擎的预览。

存储引擎功能摘要：

|   特性     | MyISAM | Memory |	InnoDB| Archive | NDB |
|-----------|--------|--------|-------|---------|-----|
|  存储限制   | 256TB | 	RAM   |  64TB | None    | 384EB|
|  事务      | No | 	No   |  Yes | No  | Yes|
| 锁定粒度     | 表 | 	表  |  行 | 行 | 行|
|MVCC    | No | 	No   |  Yes | No  | No|
|地理空间数据类型支持| Yes | 	No   |  Yes | Yse | Yes|
|地理空间索引支持| Yes | 	No   |  Yes[a] | No | No|
|B树索引| Yes | 	Yes  |  Yes | No | No|
|T树索引| No | No |  No | No | Yes|
|哈希索引| No | Yes |  No[b] | No | Yes|
|全文搜索索引| Yes | No |  Yes[c] | Yes | No|
|聚集索引| No | 	No   |  Yes | No  | No|
|数据缓存|No|	N/A	|Yes|No|Yes|
|索引缓存|Yes|	N/A	|Yes|No|Yes|
|压缩数据|Yes[d]|	No|Yes[e]|Yes|No|
|加密数据[f]|Yes|	Yes|Yes|Yes|Yes|
|集群数据库的支持|No|No|No|No|No|
|复制支持[g]|Yes|	Yes|Yes|Yes|Yes|
|外键支持|No|	No|	Yes|No|No|
|备份/点即时恢复[h]|Yes|	Yes|Yes|Yes|Yes|
|查询缓存支持|Yes|	Yes|Yes|Yes|Yes|
|数据字典更新统计|Yes|	Yes|Yes|Yes|Yes|

[a] InnoDB支持地理空间索引在MySQL5.7.5版本或者更高的版本是可用的

[b] InnoDB为了其适应性哈希索引功能利用内部的哈希索引

[c] InnoDB支持全文索引在MySQL5.6.4版本或者更高的版本是可用的

[d] 压缩MyISAM表只有当使用压缩行格式是支持的。表使用MyISAM的压缩行格式只能读。

[e] 压缩InnoDB表需要InnoDB Barracuda文件格式。

[f] 在服务器中实施（通过加密功能）。数据静止加密表，在MySQL5.7版本或者更高的版本是可用的。

[g] 实施在服务器，而不是在存储引擎。

[h] 实施在服务器，而不是在存储引擎。