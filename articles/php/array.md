# [数组函数](http://php.net/manual/zh/ref.array.php)



## array_shift 

将数组开头的单元移出数组

```
$parts = [0=>'a'];
array_shift($parts);
```
返回 `a`

**不可以这么写**`array_shift([0=>'a'])`
否则报错信息是**Only variables can be passed by reference**