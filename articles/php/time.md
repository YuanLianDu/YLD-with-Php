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

**Notice**:第一个参数$date，规定由`date_create()`返回的 DateTime 对象。

常用的格式化时间函数是，`date`,它可以将一个时间戳转化为我们想要的格式,并返回一个字符串,以下为各种格式的转化:

```
function dumpTime()
{
	var_dump(date('Y-m-d H:i:s',time()));//string(19) "2016-12-26 11:31:37"
	var_dump(date('d/m/Y H:i:s',time()));//string(19) "26/12/2016 11:31:37"
	var_dump(date('d/m/y',time()));//string(8) "26/12/16"
	var_dump(date('g:i A',time()));//string(8) "11:31 AM"
	var_dump(date('G:ia',time()));//string(7) "11:31am"
	var_dump(date('g:ia \o\n l jS F Y',time()));//string(36) "11:31am on Monday 26th December 2016"
}
```

### unix时间转化

`strtotime`将任何英文文本的日期时间描述解析为 Unix 时间戳:

+ `echo strtotime("1991-10-11 10:00:00")`
+ `echo strtotime("now")`
+ `echo strtotime("10 September 2000")`
+ `echo strtotime("+1 day")`
+ `echo strtotime("+1 week")`
+ `echo strtotime("+1 week 2 days 4 hours 2 seconds")`
+ `echo strtotime("next Thursday")`
+ `echo strtotime("last Monday")`


### 计算时间差

1、利用秒数，计算两个时间相差xx天xx小时xx分钟xx秒

```
function timeInterval() {
	$time = strtotime('2016-11-11 13:10:11');
	$timeOne = strtotime('2016-11-01 12:00:00');
	$interval = $time - $timeOne;
	$sec = $interval%60;
	$minu  = floor($interval/3600/24);
	$hour = floor($interval%(3600*24)/3600);
	$day = floor($interval/(3600*24));
	echo $day.'day'.$hour.'hour'.$minu.'minu'.$sec.'sec';
}
```

输出：`10day1hour10minu11sec`


2、利用date对象，计算两个时间相差xx天xx小时xx分钟xx秒

```
function timeIntervalByDateObject() {

	$timestamp = '1478833871';
	$datetime = new DateTime(date('Y-m-d H:i:s', $timestamp));
	$datetime_now = new DateTime();
	$interval = $datetime_now->diff($datetime);
//	var_dump($interval);
	echo $interval->days.'day'.$interval->h.'hour'.$interval->i.'minu'.$interval->s.'sec';
}
```

输出：`45day4hour18minu7sec`;

打印的inter对象结构： 
```
object(DateInterval)#3 (15) {
  ["y"]=>
  int(0)
  ["m"]=>
  int(1)
  ["d"]=>
  int(15)
  ["h"]=>
  int(3)
  ["i"]=>
  int(55)
  ["s"]=>
  int(23)
  ["weekday"]=>
  int(0)
  ["weekday_behavior"]=>
  int(0)
  ["first_last_day_of"]=>
  int(0)
  ["invert"]=>
  int(1)
  ["days"]=>
  int(45)
  ["special_type"]=>
  int(0)
  ["special_amount"]=>
  int(0)
  ["have_weekday_relative"]=>
  int(0)
  ["have_special_relative"]=>
  int(0)
}
```

### 比较时间大小

利用`strtotime()`函数，将时间转化为时间戳。可以直接利用运算符，对两个时间戳进行比较～

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

持续补充ing