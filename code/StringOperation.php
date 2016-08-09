<?php

function funcChop()
{
	$str = "Hello YLD!";
	echo $str . "<br>";
	echo chop($str, "YLD!") . "<br>";
	echo rtrim($str, "YLD!") . "<br>";
}

function funcLtrim()
{
	$str = "~Hello small yellow luo";
	echo $str . "<br>";
	echo ltrim($str, "~Hello") . "<br>";
	echo ltrim($str, "~he") . "<br>";//区分大小写的；
	echo ltrim($str, "ll") . "<br>";//必须从左侧第一个字符开始、连贯；
}

function funcTrim()
{
	$question = " \0 what's up? \r";
	$answer = " no";
	var_dump($question . $answer);
	var_dump(trim($question) . trim($answer));
}

function funcNl2br()
{
	echo nl2br("luo is \n ugly \r\n");
	$string = "Small\r\nYellow\n\rLuo\nis\rstupid";
	echo nl2br($string, false);
}

function funcPrintf()
{
	//与java中格式化输出一样
	printf('I need to pay $%.02lf', 1.3568);
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

function funcSprintf()
{
	$number = 2;
	$location = "HangZhou";
	//与printf相比，只有格式化的功能，没有打印的功能
	$text = sprintf("I have %u friends in %s", $number, $location);
	echo $text;
}

function funcStrtoupper()
{
	$str = "i want to become upper";
	echo $str . "<br>";
	$str = strtoupper($str);
	echo $str;
}

function funcStrtolower()
{
	$str = "I WANT TO BECOME LOWER";
	echo $str . "<br>";
	$str = strtolower($str);
	echo $str;
}

function funcUcfirst()
{
	//upper capitalize first的缩写，maybe
	$str = "i want to become upper";
	echo $str . "<br>";
	$str = ucfirst($str);
	echo $str . "<br>";
// note:只有第一个单词的首字母大写了哦
}

function funcUcwords()
{
	$str = "yld want to become upper";
	echo $str . "<br>";
	$str = ucwords($str);
	echo $str . "<br>";
	//note:每个单词的首字母都变成大写了哦
}

function funcAddslashes()
{
//add slashes 添加反斜杠
	$str = 'Hi Y"LD ';
	$str = addslashes($str);
	echo $str . "<br>";
	$str_one = "Hi Y'LD";
	$str_one = addslashes($str_one);
	echo $str_one . "<br>";
	//var_dump(get_magic_quotes_gpc($str_one));
	//默认地，PHP 对所有的 GET、POST 和 COOKIE 数据自动运行 addslashes()。
	//所以您不应对已转义过的字符串使用 addslashes()，因为这样会导致双层转义。
	//遇到这种情况时可以使用函数 get_magic_quotes_gpc() 进行检测。
	var_dump(get_magic_quotes_gpc());
}

function funcStripslashes()
{
//反引用一个引用字符串
	$str = "Hi Y\'LD";
	echo stripslashes($str);
}

//funcExplode();
/**
 * 使用一个字符串分割另一个字符串
 * array explode ( string $delimiter , string $string [, int $limit ] )
 * delimiter 边界上的分隔字符。
 * string 输入的字符串。
 * limit 如果设置了limit参数并且是正数，则返回的数组包含最多limit个元素，而最后那个元素将包含 string 的剩余部分。
 * 如果 limit 参数是负数，则返回除了最后的 -limit 个元素外的所有元素。
 * 如果 limit 是 0，则会被当做 1。
 */
function funcExplode()
{

	$str = 'one|two||three|four';

	// 默认输出
	print_r(explode('|', $str));
	// 正数的 limit note:three和four成为了同一个字符串
	print_r(explode('|', $str, 4));

	// 负数的 limit（自 PHP 5.1 起） note:four没有被输出
	print_r(explode('|', $str, -1));
}

//funcImplode();
/**
 * 将一个一维数组的值转化为字符串 别名：join
 * string implode ( string $glue , array $pieces )
 */
function funcImplode()
{
	$arr = array('one-dimensional', 'array', 'values', 'can', 'be', 'converted', 'to', 'string');
	$arr = implode(' ', $arr);
	print_r($arr);
}

//funcStrtok();
/**
 * 标记分割字符串
 * string strtok ( string $str , string $token )
 * str 被分成若干子字符串的原始字符串。
 * token 分割 str 时使用的分界字符
 * note:此函数可能返回布尔值 FALSE，但也可能返回等同于 FALSE 的非布尔值。应使用===运算符来测试返回值
 */
function funcStrtok()
{
	$str = "I \nlove \tlaravel";
	$tok = strtok($str, "\n\t");
	while ($tok !== false) {
		echo "Word=$tok<br />";
		$tok = strtok(" \n\t");
	}
}

//funcSubstr();
/**
 * 返回字符串的子串
 * string substr ( string $string , int $start [, int $length ] )
 */
function funcSubstr()
{
	$str = 'abcdefg';

	echo 'str: ';
	var_dump($str);
	echo 'start=1: ';
	var_dump(substr($str, 1));
	echo 'start=1 length=-1: ';
	var_dump(substr($str, 1, -1));
	echo 'start=1 length=0: ';
	var_dump(substr($str, 1, 0));
	echo 'start=1 length=2: ';
	var_dump(substr($str, 1, 2));
	echo 'start=3 length=9>count($str): ';
	var_dump(substr($str, 3, 9));
	echo 'start=8: ';
	var_dump(substr($str, 8));
	echo 'start=-3: ';
	var_dump(substr($str, -3));
	echo 'start=-1 length=-4: ';
	var_dump(substr($str, -1, -4));
	echo 'start=-3 length=2: ';
	var_dump(substr($str, -3, 2));
}

funcStrcmp();
/**
 * 二进制安全字符串比较,区分大小写
 * int strcmp ( string $str1 , string $str2 )
 * 如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
 */
function funcStrcmp()
{
	var_dump(strcmp('hi', 'hi'));
	var_dump(strcmp('Hi', 'hi'));
	var_dump(strcmp('hi', 'Hi'));
}

funcStrcasecmp();
/**
 *  二进制安全比较字符串（不区分大小写）
 * int strcasecmp ( string $str1 , string $str2 )
 * 如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。
 */
function funcStrcasecmp()
{
	var_dump(strcmp('hi', 'hi'));
	var_dump(strcmp('hi', 'Hi'));
	var_dump(strcmp('hi', 'Hh'));
}

funcStrnatcmp();
function funcStrnatcmp()
{
	$arr1 = $arr2 = array("img12.png", "img10.png", "img2.png", "img1.png");
	echo "标准字符串比较\n";
	usort($arr1, "strcmp");
	print_r($arr1);
	echo "\n自然秩序的字符串比较\n";
	usort($arr2, "strnatcmp");
	print_r($arr2);
}

funcstrlen();
function funcstrlen()
{
	$str = 'how long is my leg';
	var_dump($str);
	var_dump(strlen($str));
}

funcStrstr();
/**
 * 返回自字符出现到整个字符串结尾的部分
 * 区分大小写 别名：strchr()
 */
function funcStrstr()
{
	$email = 'name@example.com';
	$domain = strstr($email, '@');
	var_dump($domain); // 打印 @example.com

	$user = strstr($email, '@', true); // 从 PHP 5.3.0 起
	var_dump($user); // 打印 name
}

funcStrrchr();
/**
 * 查找指定字符在字符串中的最后一次出现
 */
function funcStrrchr()
{
	$path = '/www/public_html/index.html';
	var_dump(strrchr($path, "/"));
	$filename = substr(strrchr($path, "/"), 1);
	var_dump($filename);
}

/**
 * strstr() 函数的忽略大小写版本
 */
function funcStristr()
{
}

funcStrpos();
/**
 * 查找字符串首次出现的位置
 */
function funcStrpos()
{
	$string = "hello hello hello hello";
	$find = "e";
	// e的位置是1、7、13、19
	var_dump(strpos($string, $find, 1));//从开始数，第1个位置开始查找
	var_dump(strpos($string, $find, 3));//从开始数，第3个位置开始查找
	var_dump(strpos($string, $find, 8));//从开始数，第8个位置开始查找
}

funcStrrpos();
/**
 * 计算指定字符串在目标字符串中最后一次出现的位置
 * int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )
 */
function funcStrrpos()
{
	$string = "hello hello hello hello";
	$find = "e";
	var_dump(strrpos($string, $find));
	var_dump(strrpos($string, $find, -5));//从末尾数，第5个位置开始查找
	var_dump(strrpos($string, $find, -23));//
}

funcStrReplace();
/**
 * 子字符串替换
 */
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

funcSubstrReplace();
/**
 * 替换字符串的子串
 */
function funcSubstrReplace()
{
	$str = "Hello,YLD.Would you like eat something?";
	$replace = "Hi";
	var_dump(substr_replace($str,$replace,0));
	var_dump(substr_replace($str,$replace,0,5));
	var_dump(substr_replace($str,$replace,0,-7));
}

