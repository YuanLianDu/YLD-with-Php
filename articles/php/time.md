# PHP时间处理相关函数及开发技巧

## 时间函数列表

## 开发技巧

### 格式化时间
### unix时间转化
### 计算时间差
### 比较时间大小
### [时间人性化显示](https://segmentfault.com/q/1010000006702691)

```
function getDiffTime($timestamp)
{
	$datetime = new DateTime(date('Y-m-d H:i:s', $timestamp));
	$datetime_now = new DateTime();
	$interval = $datetime_now->diff($datetime);
	list($y, $m, $d, $h, $i, $s) = explode('-', $interval->format('%y-%m-%d-%h-%i-%s'));
	if ((($result = $y) && ($suffix = '年前')) ||
		(($result = $m) && ($suffix = '月前')) ||
		(($result = $d) && ($suffix = '天前')) ||
		(($result = $h) && ($suffix = '小时前')) ||
		(($result = $i) && ($suffix = '分钟前')) ||
		(($result = $s) && ($suffix = '刚刚'))) {

		return $suffix != '刚刚' ? $result . $suffix : $suffix;
	}
}
```