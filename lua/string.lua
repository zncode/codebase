
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

