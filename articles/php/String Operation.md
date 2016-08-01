# 字符串操作

## 字符串的整理：
### chop()
 + 除字符串右端的空白字符或其他预定义字符
 + chop(string,charlist)
   - string：必需。规定要检查的字符串。
   - charlist:可选。规定从字符串中删除哪些字符。
            如果 charlist 参数为空，则移除以下字符：
            "\0" - NULL
            "\t" - 制表符
            "\n" - 换行
            "\x0B" - 垂直制表符
            "\r" - 回车
            " " - 空格
 
    
              
                
### ltrim()
###  trim()