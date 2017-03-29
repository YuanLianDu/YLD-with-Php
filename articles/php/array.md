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


## array_reverse

将数组单元翻转

## array_reduce

递归处理数组的每个元素

**可以与call_user_func()配合，可以实现装饰模式的自动化**