#Laravel 多对多关系模型总结
## 介绍
 以user和role用来举例：每一个user可以用户很多role，而每一个role可以对应很多user。这是一个典型的多对多关联模型。
## 简单的数据库设计
1. user表：id  name
2. role表：id name
3. user_roles表：id  user_id role_id

## model 关联 
### user
```php
public  function roles() {
		return $this->belongsToMany('App\Model\Role','user_roles','user_id','role_id');
	}
```
### role
```php
public function users() {
		return $this->belongsToMany('App\Model\User','user_roles','role_id','user_id');
	}
```

## 控制器method
### create
`$role = User:find(1)->roles()->create(['name'=>'JS']);`
roles表增加一条记录，中间表增加一条记录.
#####注意：create只接收数组
### save
```php
$role = new Roles(['name'=>'java'])
$user = User::find(1);
$role = $user->roles()->save($role);
```
结果同上
###attach:附加关联关系到模型,给一个用户增加角色，在关联表中添加数据
`User::find(1)->roles()->attach([5,6]);`
###detach 解除关联关系 ，删除用户的某个角色，在关联表中删除数据
`User::find(1)->roles()->detach([5,6]);`
###sync:以数组的形式接收id放置到中间表中，不在此数组的id中间表记录将被删除
```table
id | user_id |roles_id
1 |  1 | 1
2 | 1 | 3
```
执行：`User::find(1)->roles()->sync([1,2]);`
结果为：
```table
id | user_id | roles_id
1 | 1 | 1
3| 1 | 2
```
看id为2的记录被删除啦，新增了一个id为3
的记录。




