mongodb数据库扩展 `mongo` 和 `mongodb的区别？`

+ `mongo`这个扩展已经废弃了，不过`bug`和`security`方面的问题还会继续修复，**不支持PHP7**

+ `mongodb` 支持PHP7,同时不断加入 `MongoDB` 新版本的特性支持

原本用 mongo 一些查询操作返回一个数组的，在 mongodb 中变成游标读取的形式。


[mongo extension install](http://php.net/manual/zh/mongo.installation.php#mongo.installation.nix)
[mongodb extension install](http://php.net/manual/zh/mongodb.installation.pecl.php)