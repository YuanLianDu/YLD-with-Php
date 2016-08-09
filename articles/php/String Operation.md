# Php常用函数系列之字符串处理
+ 字符串的格式化
 - rtrim(),除字符串右端的空白字符或其他预定义字符
 - ltrim(),删除字符串开头空格或者预定的其它字符
 - trim(),此函数返回字符串 str 去除首尾空白字符后的结果
+ 格式化字符串以便输出
 - nl2br(),在字符串所有新行之前插入 HTML 换行标记
 - printf(),输出格式化字符串
 - sprintf(),把格式化的字符串写入变量中
+ 改变字符串的字母大小写
 - strtoupper(),将字符串转换为大写
 - strtolower(),将字符串转化为小写
 - ucfirst(),将字符串中的第一个单词的首字母转化为大写
 - ucwords(),将字符串中的每一个单词的首字母转化为大写
+ 格式化字符串以便存储
 - addslashes(),使用反斜线引用字符串
 - stripslashes(),反引用一个引用字符串
+ 连接、分割字符串
 - explode(),使用一个字符串分割另一个字符串
 - implode(),将一个一维数组的值转化为字符串;别名：join()
 - stroke(),标记分割字符串
 - substr(),返回字符串的子串
+ 字符串的排序
 - strcmp(),二进制安全字符串比较,区分大小写
 - strcasecmp(),二进制安全比较字符串（不区分大小写）
 - strnatcmp(),使用自然排序算法比较字符串
+ 测试字符串长度
 - strlen(),返回字符串长度
+ 字符串中查找字符串
 - strstr(),查找字符串的首次出现,别名：strchr().
 - strchr(),strstr()的别名.
 - strrchr(),查找指定字符在字符串中的最后一次出现.
 - stristr(),strstr() 函数的忽略大小写版本
+ 查找字符串的位置
   - strpos(),查找字符串首次出现的位置
   - strrpos(),计算指定字符串在目标字符串中最后一次出现的位置
+ 替换子字符串
  - str_replace(),搜索目标字符串，并替换字符串.
  - substr_replace(),确定要替换的字符串位置，替换字符串的子串.
   

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
+ 函数示例：

```
function funcExplode() {

	$str = 'one|two||three|four';

	// 默认输出
	print_r(explode('|',$str));
    // 正数的 limit note:three和four成为了同一个字符串
	print_r(explode('|', $str, 4));

    // 负数的 limit（自 PHP 5.1 起） note:four没有被输出
	print_r(explode('|', $str, -1));
}
```

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
+ 将一个一维数组的值转化为字符串;别名：join()
+ string implode ( string $glue , array $pieces )
 - glue 默认为空的字符串
 - pieces 你想要转换的数组
+ 函数示例：

```
function funcImplode() {
	$arr = array('one-dimensional','array','values','can','be','converted','to','string');
	$arr = implode(' ',$arr);
	print_r($arr);
}
```

+ 输出：

```
one-dimensional array values can be converted to string
```

#### stroke()
+ 标记分割字符串
+ string strtok ( string $str , string $token )
 - str 被分成若干子字符串的原始字符串
 - token 分割 str 时使用的分界字符
+ note:此函数可能返回布尔值 FALSE，但也可能返回等同于 FALSE 的非布尔值。应使用===运算符来测试返回值
+ 函数示例：

```
function funcStrtok() {
	$str = "I \nlove \tlaravel";
	$tok = strtok($str,"\n\t");
	while ($tok !== false) {
		echo "Word=$tok<br />";
		$tok = strtok(" \n\t");
	}
}
```

+ 输出：

```
Word=I 
Word=love
Word=laravel
```

#### substr()
+ 返回字符串的子串
+ string substr ( string $string , int $start [, int $length ] )
 - string 输入字符串。必须至少有一个字符
 - start
   * 如果 start>0，返回的字符串将从 string 的 start 位置开始，从 0 开始计算
   * 如果 start<0，返回的字符串将从 string 结尾处向前数第 start 个字符开始
   * 如果 string 的长度小于 start，将返回 FALSE
 - length
   * 如果length>0，返回的字符串将从 start 处开始最多包括 length 个字符（取决于 string 的长度）。
   * 如果length<0，那么 string 末尾处的许多字符将会被漏掉（若 start 是负数则从字符串尾部算起）。如果 start 不在这段文本中，那么将返回一个空字符串。
   * 如果length=0，FALSE 或 NULL 的 length，那么将返回一个空字符串。
   * 如果没有提供 length，返回的子字符串将从 start 位置开始直到字符串结尾。
   
+ 函数示例：

```
function funcSubstr() {
	$str = 'abcdefg';

    echo 'str: ';var_dump($str);
	echo 'start=1: ';var_dump(substr($str,1));
	echo 'start=1 length=-1: ';var_dump(substr($str,1,-1));
	echo 'start=1 length=0: ';var_dump(substr($str,1,0));
	echo 'start=1 length=2: ';var_dump(substr($str,1,2));
	echo 'start=3 length=9>count($str): ';var_dump(substr($str,3,9));
	echo 'start=8: ';var_dump(substr($str,8));
	echo 'start=-3: ';var_dump(substr($str,-3));
	echo 'start=-1 length=-4: ';var_dump(substr($str,-1,-4));
	echo 'start=-3 length=2: ';var_dump(substr($str,-3,2));

}
```

+ 输出：
```
str: string(7) "abcdefg"
start=1: string(6) "bcdefg"
start=1 length=-1: string(5) "bcdef"
start=1 length=0: string(0) ""
start=1 length=2: string(2) "bc"
start=3 length=9>count($str): string(4) "defg"
start=8: bool(false)
start=-3: string(3) "efg"
start=-1 length=-4: string(0) ""
start=-3 length=2: string(2) "ef"
```

## 3.字符串的比较
### 3.1 字符串的排序
#### strcmp()
 + 二进制安全字符串比较,区分大小写
 + int strcmp ( string $str1 , string $str2 )
 + 返回值，如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
 + 函数示例：
 
 ｀｀｀
 function funcStrcmp() {
 	var_dump(strcmp('hi','hi'));
 	var_dump(strcmp('Hi','hi'));
 	var_dump(strcmp('hi','Hi'));
 }
 ｀｀｀
 
+ 输出：

｀｀｀
int(0)
int(-32)
int(32)
｀｀｀

#### strcasecmp()
+  二进制安全比较字符串（不区分大小写）
+ int strcmp ( string $str1 , string $str2 )
+ 返回值，如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
+ 函数示例：

```
function funcStrcasecmp() {
	var_dump(strcmp('hi','hi'));
	var_dump(strcmp('hi','Hi'));
	var_dump(strcmp('hi','Hh'));
}
```

+ 输出：
```
int(0)
int(32)
int(32)
```

#### strnatcmp()
+ 使用自然排序算法比较字符串
+ int strnatcmp ( string $str1 , string $str2 )
+ 返回值，如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
+ 函数示例：
```
function funcStrnatcmp() {
	$arr1 = $arr2 = array("img12.png", "img10.png", "img2.png", "img1.png");
	echo "标准字符串比较\n";
	usort($arr1, "strcmp");
	print_r($arr1);
	echo "\n自然秩序的字符串比较\n";
	usort($arr2, "strnatcmp");
	print_r($arr2);
}
```

+ 输出：

```
标准字符串比较
Array
(
    [0] => img1.png
    [1] => img10.png
    [2] => img12.png
    [3] => img2.png
)

自然秩序的字符串比较
Array
(
    [0] => img1.png
    [1] => img2.png
    [2] => img10.png
    [3] => img12.png
)
```

### 3.2 测试字符串长度
#### strlen()
+ 返回字符串长度
+ int strlen ( string $string )
+ 函数示例：

```

function funcstrlen() {
	$str = 'how long is my leg';
	var_dump($str);
	var_dump(strlen($str));
}
```

+ 输出:

```
string(18) "how long is my leg"
int(18)
```

## 4.字符串查找和替换
### 4.1 字符串中查找字符串
#### strstr() 别名：strchr()
+ 查找字符串的首次出现
+ string strstr ( string $haystack , mixed $needle [, bool $before_needle = false ] )
+ 函数示例：

```
function funcStrstr()
{
	$email = 'name@example.com';
	$domain = strstr($email, '@');
	var_dump($domain); // 打印 @example.com

	$user = strstr($email, '@', true); // 从 PHP 5.3.0 起
	var_dump($user); // 打印 name
}
```

+ 输出：

```
string(12) "@example.com"
string(4) "name"
```

#### stristr()
+ strstr() 函数的忽略大小写版本,用法同上.

#### strrchr()
+ 查找指定字符在字符串中的最后一次出现
+ string strrchr ( string $haystack , mixed $needle )
+ 函数示例：

```
function funcStrrchr()
{
	$path = '/www/public_html/index.html';
	var_dump(strrchr($path, "/"));
	$filename = substr(strrchr($path, "/"), 1);
	var_dump($filename);
}
```

+ 输出：

```
string(11) "/index.html"
string(10) "index.html"
```


### 4.2 查找字符串的位置
#### strpos()
+ 查找字符串首次出现的位置
+ int strpos ( string $haystack , string $needle [, int $offset = 0 ] )
+ 函数示例：

```
function funcStrpos()
{
	$string = "hello hello hello hello";
	$find = "e";
	// e的位置是1、7、13、19
	var_dump(strpos($string, $find, 1));//从开始数，第1个位置开始查找
	var_dump(strpos($string, $find, 3));//从开始数，第3个位置开始查找
	var_dump(strpos($string, $find, 8));//从开始数，第8个位置开始查找
}
```

+ 输出：

```
int(1)
int(7)
int(13)
```
#### strrpos()
+ 计算指定字符串在目标字符串中最后一次出现的位置
+ int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )
+ 函数示例：

```
function funcStrrpos()
{
	$string = "hello hello hello hello";
	$find = "e";
	var_dump(strrpos($string, $find));
	var_dump(strrpos($string, $find, -5));//从末尾数，第5个位置开始查找
	var_dump(strrpos($string, $find, -23));//
}
```

+ 输出：

```
int(19)
int(13)
bool(false)
```


### 4.3 替换子字符串
#### str_replace()
+ 搜索目标字符串，并替换字符串
+ mixed str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
 - search,查找的目标值，可以是字符串，也可以是一维数组
 - replace,search 的替换值，可以是字符串，也可以是一维数组
 - subject,执行替换的字符串或者数组，可以是字符串，也可以是一维数组
 - count,只允许是一个variables。是执行替换的次数
 
+ 函数示例：

```
function funcStrReplace()
{
	//search replace 都为数组 且replace的值少于search的值
	// 多余的替换会使用空字符
	$phrase = "You should eat fruits, vegetables, and fiber every day.";
	$healthy = array("fruits", "vegetables", "fiber");
	$yummy = array("pizza", "beer");
	$newphrase = str_replace($healthy, $yummy, $phrase);
	var_dump($newphrase);

	//search replace 都为字符串
	$str = str_replace("ll", "", "good golly miss molly!", $count);
	var_dump($str);
	var_dump($count);

	// 输出 F ，因为 A 被 B 替换，B 又被 C 替换，以此类推...
	// 由于从左到右依次替换，最终 E 被 F 替换
	$search = array('A', 'B', 'C', 'D', 'E');
	$replace = array('B', 'C', 'D', 'E', 'F');
	$subject = 'A';
	var_dump(str_replace($search, $replace, $subject));

	// 输出: apearpearle pear
	// 由于上面提到的原因
	$letters = array('a', 'p');
	$fruit = array('apple', 'pear');
	$text = 'a p';
	$output = str_replace($letters, $fruit, $text);
	var_dump($output);

}
```

+ 输出：

```
string(43) "You should eat pizza, beer, and  every day."
string(18) "good goy miss moy!"
int(2)
string(1) "F"
string(16) "apearpearle pear"
```

#### substr_replace()
+ 确定要替换的字符串位置，替换字符串的子串
+ mixed substr_replace ( mixed $string , mixed $replacement , mixed $start [, mixed $length ] )
 - string,输入的字符串
 - replacement,替换字符串
 - start,字符串开始位置
 - length,
  * 正数，表示 string 中被替换的子字符串的长度
  * 负数，它表示待替换的子字符串结尾处距离 string 末端的字符个数

+ 函数示例：

```
function funcSubstrReplace()
{
	$str = "Hello,YLD.Would you like eat something?";
    $replace = "Hi";
    var_dump(substr_replace($str,$replace,0));
    var_dump(substr_replace($str,$replace,0,5));
    var_dump(substr_replace($str,$replace,0,-7));
}
```

+ 输出:

```
string(2) "Hi"
string(36) "Hi,YLD.Would you like eat something?"
string(9) "Hiething?"
```
