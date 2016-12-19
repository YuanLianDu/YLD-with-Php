# PHP时间处理

## 时间函数列表

+ checkDate(month,day,year)，验证是否是有效的公历日期。[Api](https://secure.php.net/manual/zh/function.checkdate.php)
+ date_add(object,interval)，向某个日期添加日、月、年、时、分和秒。[Api](https://secure.php.net/manual/zh/function.date-add.php)
+ date_create_from_format,返回根据指定格式进行格式化的新的 DateTime 对象。[Api](https://secure.php.net/manual/zh/function.date-create-from-format.php)
+ date_create,返回新的 DateTime 对象。[Api](https://secure.php.net/manual/zh/function.date-create.php)
+ date_date_set,设置时间。[Api](https://secure.php.net/manual/zh/function.date-date-set.php)
+ date_default_timezone_get,取得一个脚本中所有日期时间函数所使用的默认时区。[Api](https://secure.php.net/manual/zh/function.date-default-timezone-get.php)
+ date_default_timezone_set,设定用于一个脚本中所有日期时间函数的默认时区。[Api](https://secure.php.net/manual/zh/function.date-default-timezone-set.php)
+ date_diff,返回两个日期间的差值。[Api](https://secure.php.net/manual/zh/function.date-diff.php)
+ date_format,格式化一个时间。[Api](https://secure.php.net/manual/zh/datetime.format.php)
+ date_interval_format,格式化时间间隔。[Api](https://secure.php.net/manual/zh/dateinterval.format.php)
+ date_isodate_set,根据 ISO 8601 标准设置日期，使用周和天的偏移量（而不是使用一个具体的日期）。[Api](https://secure.php.net/manual/zh/function.date-isodate-set.php)
+ date_modify,修改date时间，返回时间戳。[Api](https://secure.php.net/manual/zh/datetime.modify.php)
+ date_offset_get,返回两个日期的时间偏移。单位：秒。[Api](https://secure.php.net/manual/zh/function.date-offset-get.php)
+ date_parse_from_format,根据给定的日期和format，返回一个包含日期的关联数组。 [Api](https://secure.php.net/manual/zh/function.date-parse-from-format.php)
+ date_parse,返回指定日期的关联数组。[Api](https://secure.php.net/manual/zh/function.date-parse.php)



`date`开头的函数是过程化风格，还有相应的对象化风格。
## 开发实践

### 格式化时间

+ `date_format($date, 'Y-m-d H:i:s');` 输出：`2012-03-24 17:45:12`
+ `date_format($date, 'd/m/Y H:i:s');` 输出：`24/03/2012 17:45:12`
+ `date_format($date, 'd/m/y');` 输出：`24/03/12`
+ `date_format($date, 'g:i A');` 输出：`5:45 PM`
+ `date_format($date, 'G:ia');` 输出：`05:45pm`
+ `date_format($date, 'g:ia \o\n l jS F Y');` 输出：`5:45pm on Saturday 24th March 2012`


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