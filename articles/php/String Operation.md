# 字符串操作

## 1. 字符串的格式化
### 1.1 字符串的整理：
#### rtrim(),chop()是此函数的别名，可以理解为小名。
 + 除字符串右端的空白字符或其他预定义字符
 + chop(string,charlist)
   - string：必需。规定要检查的字符串。
   - charlist:可选。规定从字符串中删除哪些字符。<br/>
            如果 charlist 参数为空，则移除以下字符：<br/>
            "\0" - NULL<br/>
            "\t" - 制表符<br/>
            "\n" - 换行<br/>
            "\x0B" - 垂直制表符<br/>
            "\r" - 回车<br/>
            " " - 空格
            
+ 函数示例：
 
 ```
function funcChop() {
    $str = "Hello YLD!";
	echo $str . "<br>";
	echo chop($str,"YLD!"). "<br>";
	echo rtrim($str,"YLD!")."<br>";//chop()是此函数的别名，可以理解为小名。
}
 ```
 
+ 输出：
 
 ```
Hello YLD!
Hello
Hello
 ```
            
#### ltrim()
+ 删除字符串开头空格或者预定的其它字符
+ ltrim(string,charlist)
 - string,必需。规定要转换的字符串。
 - charlist,可选。规定从字符串中删除哪些字符。<br/>
            如果未设置该参数，则全部删除以下字符<br/>
            "\0" - ASCII 0, NULL<br/>
            "\t" - ASCII 9, 制表符<br/>
            "\n" - ASCII 10, 新行<br/>
            "\x0B" - ASCII 11, 垂直制表符<br/>
            "\r" - ASCII 13, 回车<br/>
            " " - ASCII 32, 空格<br/>
            
+ 函数示例：

```
function funcLtrim() {
    $str = "~Hello small yellow luo";
	echo $str."<br>";
	echo ltrim($str,"~Hello")."<br>";
	echo ltrim($str,"~he")."<br>";//区分大小写的；字符串必须连贯
	echo ltrim($str,"ll")."<br>";//必须从左侧第一个字符开始；
}
```

+ 输出：

```
~Hello small yellow luo
small yellow luo
Hello small yellow luo
~Hello small yellow luo
```


#### trim()
+ 此函数返回字符串 str 去除首尾空白字符后的结果。
+ ltrim(string,charlist)
 - string,必需。规定要转换的字符串。
 - charlist,可选。规定从字符串中删除哪些字符。<br/>
            如果未设置该参数，则全部删除以下字符<br/>
            "\0" - ASCII 0, NULL<br/>
            "\t" - ASCII 9, 制表符<br/>
            "\n" - ASCII 10, 新行<br/>
            "\x0B" - ASCII 11, 垂直制表符<br/>
            "\r" - ASCII 13, 回车<br/>
            " " - ASCII 32, 空格<br/>
            
+ 函数示例：
 
 ```
function funcTrim() {
	$question = " \0 what's up? \r";
	$answer = " no";
	var_dump($question.$answer);
	var_dump(trim($question).trim($answer));
}
 ```
 
+ 输出：
 ```
string(18) " what's up? no" 
string(12) "what's up?no"  //注意字符串的个数变化
 ```
 
### 1.2 格式化字符串以便输出
#### 1.2.1 nl2br()
+ 在字符串所有新行之前插入 HTML 换行标记.
+ 在字符串 string 所有新行之前插入`<br />` 或 `<br>`，并返回。
+ string nl2br ( string $string [, bool $is_xhtml = true ] )
 - string,输入字符串
 - is_xhtml,是否使用 XHTML 兼容换行符
 
+ 函数示例：
 
 ```
function funcNl2br() {
	echo nl2br("luo is \n ugly \r\n");
	$string = "Small\r\nYellow\n\rLuo\nis\rstupid";
	echo nl2br($string,false);//注意输出换行
}
 ```
 
+ 输出：
 ```
luo is 
ugly 
Small
Yellow
Luo
is
stupid
 ```

#### 1.2.2 为打印输出而格式化
#### printf()
+ 输出格式化字符串
+ `printf ( string $format [, mixed $args [, mixed $... ]] )`
+ 函数示例：
```
function funcPrintf() {
	//与java中格式化输出一样
	printf('I need to pay $%.02lf',1.3568);
	echo "<br>";
	$goodevil = array('good', 'evil');
	//巧用printf
	printf_array('There is a difference between %s and %s', $goodevil);

}
function printf_array($format, $arr)
{
	//回调printf函数
	return call_user_func_array('printf', array_merge((array)$format, $arr));
}
```

+ 输出：

```
I need to pay $1.36
There is a difference between good and evil
 ```

#### sprintf()
+ sprintf() 函数把格式化的字符串写入变量中。
+ sprintf(format,arg1,arg2,arg++)
 - format,必需。规定字符串以及如何格式化其中的变量。可能的格式值：<br/>
                %% - 返回一个百分号 % <br/>
                %b - 二进制数  <br/>
                %c - ASCII 值对应的字符 <br/>
                %d - 包含正负号的十进制数（负数、0、正数）<br/>
                %e - 使用小写的科学计数法（例如 1.2e+2） <br/>
                %E - 使用大写的科学计数法（例如 1.2E+2） <br/>
                %u - 不包含正负号的十进制数（大于等于 0） <br/>
                %f - 浮点数（本地设置）<br/>
                %F - 浮点数（非本地设置）<br/>
                %g - 较短的 %e 和 %f  <br/>
                %G - 较短的 %E 和 %f  <br/>
                %o - 八进制数  <br/>
                %s - 字符串   <br/>
                %x - 十六进制数（小写字母） <br/>
                %X - 十六进制数（大写字母   <br/>
 - arg1,必需。规定插到 format 字符串中第一个 % 符号处的参数。
 - arg2,可选。规定插到 format 字符串中第二个 % 符号处的参数。
 - arg++,可选。规定插到 format 字符串中第三、四等 % 符号处的参数。
 
+ 函数示例：

```
function funcSprintf() {
	$number  = 2;
	$location = "HangZhou";
	//与printf相比，只有格式化的功能，没有打印的功能
	$text = sprintf("I have %u friends in %s",$number,$location);
	echo $text;
}
```

+ 输出：

```
I have 2 friends in HangZhou
```

### 1.3 改变字符串的字母大小写
#### strtoupper()
+ 将字符串转换为大写
+ string strtoupper ( string $string )
+ 函数示例：

```
function funcStrtoupper() {
	$str = "i want to become upper";
	echo $str."<br>";
	$str = strtoupper($str);
	echo $str;
}
```

+ 输出：

```
i want to become upper
I WANT TO BECOME UPPER
```

#### strtolower()
+ 将字符串转化为小写
+ string strtolower() ( string $string )
+ 函数示例：

```
function funcStrtolower() {
	$str = "I WANT TO BECOME LOWER";
	echo $str."<br>";
	$str  = strtolower($str);
	echo $str;
}
```

+ 输出：

```
I WANT TO BECOME LOWER
i want to become lower
```

#### ucfirst()
+ 将字符串中的第一个单词的首字母转化为大写
+ string ucfirst() ( string $string )
+ 函数示例：

```
function funcUcfirst() {
	//upper capitalize first的缩写，maybe
	$str = "i want to become upper";
	echo $str."<br>";
	$str = ucfirst($str);
	echo $str."<br>";
// note:只有第一个单词的首字母大写了哦
}
```

+ 输出：

```
i want to become upper
I want to become upper
```

#### ucwords()
+ 将字符串中的每一个单词的首字母转化为大写
+ string ucwords() ( string $string )
+ 函数示例：

```
function funcUcwords() {
	$str = "yld want to become upper";
	echo $str."<br>";
	$str = ucwords($str);
	echo $str."<br>";
	//note:每个单词的首字母都变成大写了哦
}
```

+ 输出：

```
yld want to become upper
Yld Want To Become Upper
```

### 1.4 格式化字符串以便存储

#### addslashes()
+ 使用反斜线引用字符串
+ string addslashes ( string $str )
+ 函数示例：

```
function funcAddslashes() {
//add slashes 添加反斜杠
	$str = 'Hi Y"LD ';
	$str = addslashes($str);
	echo $str."<br>";
	$str_one = "Hi Y'LD";
	$str_one = addslashes($str_one);
	echo $str_one."<br>";
	//var_dump(get_magic_quotes_gpc($str_one));
	//默认地，PHP 对所有的 GET、POST 和 COOKIE 数据自动运行 addslashes()。
	//所以您不应对已转义过的字符串使用 addslashes()，因为这样会导致双层转义。
	//遇到这种情况时可以使用函数 get_magic_quotes_gpc() 进行检测。
	var_dump(get_magic_quotes_gpc());
}
```

+ 输出：

```
Hi Y\"LD 
Hi Y\'LD
bool(false)
```

#### stripslashes()
+ 反引用一个引用字符串
+ string stripslashes ( string $str )
+ 函数示例：

```
function funcStripslashes() {
//反引用一个引用字符串
	$str = "Hi Y\'LD";
	echo stripslashes($str);
}
```

+ 输出：

```
Hi Y'LD
```

## 2. 连接、分割字符串
#### explode()
+ 使用一个字符串分割另一个字符串
+ array explode ( string $delimiter , string $string [, int $limit ] )
 - delimiter 边界上的分隔字符。
 - string 输入的字符串。
 - limit 如果设置了limit参数并且是正数，则返回的数组包含最多limit个元素，而最后那个元素将包含 string 的剩余部分。
    * 如果 limit 参数是负数，则返回除了最后的 -limit 个元素外的所有元素。
    * 如果 limit 是 0，则会被当做 1。
+ 输出：

```
Array
(
    [0] => one
    [1] => two
    [2] => 
    [3] => three
    [4] => four
)
Array
(
    [0] => one
    [1] => two
    [2] => 
    [3] => three|four
)
Array
(
    [0] => one
    [1] => two
    [2] => 
    [3] => three
)
```

#### implode()
+ 别名：join()
+ 输出：

```
one-dimensional array values can be converted to string
```

#### stroke()

+ 输出：

```
Word=I 
Word=love
Word=laravel
```

#### substr()

+ 输出：
```
str: string(7) "abcdefg"
start=1: string(6) "bcdefg"
start=1 length=-1: string(5) "bcdef"
start=1 length=0: string(0) ""
start=1 length=2: string(2) "bc"
start=3 length=9>count($str): string(4) "defg"
start=8 bool(false)
start=-3 : string(3) "efg"
start=-1 length=-4: string(0) ""
start=-3 length=2: string(2) "ef"
```

## 3.字符串的比较
### 3.1 字符串的排序
+ strcmp()
+ strcasecmp()
+ strnatcmp()

### 3.2 测试字符串长度
+ strlen()

## 4.字符串查找和替换
### 4.1 字符串中查找字符串
+ strstr()
+ strchr()
+ strrchr()
+ stristr()

### 4.2 查找字符串的位置
+ strpos()
+ strrpos()

### 4.3 替换子字符串
+ str_replace()
+ substr_replace()