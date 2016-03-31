
1. string.byte(s[,i[,j]]) 
返回某个位置上的字符所对应的ASCII码，也就是一个数字
s: 字符串本身
i: 字符串的起始位置
j: 字符串的结束位置
print(string.byte("one"))
print(string.byte("one",1,3))

2. string.char() 
将数字编码转化为字符
print(string.char(72,101,108,108,111,32,87))

3. string.dump()
返回传入函数的二进制字符串

4. string.find(s,pattern[, init[, plain]])
在字符串s中搜索第一个与pattern一样的字符。如果找到的话，函数返回匹配部分的起始位置和结束位置。如果没有找到匹配字符，函数返回nil。
init: 决定了开始搜索的位置，默认为1
plain: true=匹配同时考虑占位符和通配符； false=返回纯文本的匹配字符串

5. string.format()
返回一个带格式的字符串。
string.format('%q', 'a string with "quotes" and \n line')
返回: "a string with \"quotes\" and \
new line"

6. string.gmatch(s,pattern)
返回一个迭代器函数，每次调用返回来pattern的下一个捕获，从开头至结尾，如果pattern没有指定捕获则每次调用产生整个匹配。

7.string.gsub(s, pattern, repl[, n])
使用repl替换pattern中的字符串，n表示替换次数。
str = "The data is one, is two, is three, is four, is five"
print(str:gsub("is", "are"))
print(str:gsub("is", "are", 4))

8. string.len(s)
返回字符串长度

9. string.lower(s)
返回字符串小写

10. string.match(s, pattern[, init])
查找字符串s中出现的pattern模式，如果没有返回nil。
init: 查找的起始位置，可以是负数

10. string.rep(s, n)
返回字符串s的n次重复
print(string.rep("*",10)); // **********
  
11. string.reverse(s)
返回字符串逆序

12. string.sub(s, i[, j])
返回字符串的字串
i: 起始点，默认1，可以为负值
j: 终结点，默认-1,（字符串结尾）

13. string.upper(s)
返回字符串的大写
