<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 16/8/1
 * Time: 17:06
 */
funcChop();
function funcChop() {
	$str = "Hello YLD!";
	echo $str . "<br>";
	echo chop($str,"YLD!"). "<br>";
	echo rtrim($str,"YLD!")."<br>";//chop()是此函数的别名，可以理解为小名。
}

function funcLtrim() {
	$str = "~Hello small yellow luo";
	echo $str."<br>";
	echo ltrim($str,"~Hello")."<br>";
	echo ltrim($str,"~he")."<br>";//区分大小写的；
	echo ltrim($str,"ll")."<br>";//必须从左侧第一个字符开始、连贯；
}

function funcTrim() {
	$question = " \0 what's up? \r";
	$answer = " no";
	var_dump($question.$answer);
	var_dump(trim($question).trim($answer));//注意字符串的个数变化
}

function funcNl2br() {
	echo nl2br("luo is \n ugly \r\n");
	$string = "Small\r\nYellow\n\rLuo\nis\rstupid";
	echo nl2br($string,false);//注意输出换行
}

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

function funcSprintf() {
	$number  = 2;
	$location = "HangZhou";
	//与printf相比，只有格式化的功能，没有打印的功能
	$text = sprintf("I have %u friends in %s",$number,$location);
	echo $text;
}

function funcStrtoupper() {
	$str = "i want to become upper";
	echo $str."<br>";
	$str = strtoupper($str);
	echo $str;
}

function funcStrtolower() {
	$str = "I WANT TO BECOME LOWER";
	echo $str."<br>";
	$str  = strtolower($str);
	echo $str;
}

function funcUcfirst() {
	//upper capitalize first的缩写，maybe
	$str = "i want to become upper";
	echo $str."<br>";
	$str = ucfirst($str);
	echo $str."<br>";
// note:只有第一个单词的首字母大写了哦
}

function funcUcwords() {
	$str = "yld want to become upper";
	echo $str."<br>";
	$str = ucwords($str);
	echo $str."<br>";
	//note:每个单词的首字母都变成大写了哦
}