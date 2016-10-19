# Yii系列－－数据库迁移

## 命令
+ 创建数据库：`yii migrate/create create_news_table`

如下是所有这些数据库访问方法的列表：
yii\db\Migration::execute(): 执行一条 SQL 语句
yii\db\Migration::insert(): 插入单行数据
yii\db\Migration::batchInsert(): 插入多行数据
yii\db\Migration::update(): 更新数据
yii\db\Migration::delete(): 删除数据
yii\db\Migration::createTable(): 创建表
yii\db\Migration::renameTable(): 重命名表名
yii\db\Migration::dropTable(): 删除一张表
yii\db\Migration::truncateTable(): 清空表中的所有数据
yii\db\Migration::addColumn(): 加一个字段
yii\db\Migration::renameColumn(): 重命名字段名称
yii\db\Migration::dropColumn(): 删除一个字段
yii\db\Migration::alterColumn(): 修改字段
yii\db\Migration::addPrimaryKey(): 添加一个主键
yii\db\Migration::dropPrimaryKey(): 删除一个主键
yii\db\Migration::addForeignKey(): 添加一个外键
yii\db\Migration::dropForeignKey(): 删除一个外键
yii\db\Migration::createIndex(): 创建一个索引
yii\db\Migration::dropIndex(): 删除一个索引
yii\db\Migration::addCommentOnColumn(): adding comment to column
yii\db\Migration::dropCommentFromColumn(): dropping comment from column
yii\db\Migration::addCommentOnTable(): adding comment to table
yii\db\Migration::dropCommentFromTable(): dropping comment from table

