# 字符串操作

## 字符串的整理：
### rtrim(),chop()是此函数的别名，可以理解为小名。
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
            
### ltrim()
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


###  trim()
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
string(12) "what's up?no"
 ```