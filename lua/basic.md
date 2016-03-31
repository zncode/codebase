Lua特性
----
一个用C语言编写的库来执行的，因为不需要调用其他的东西，所以自身并没有主程序。

变量
----
变量名是大小写敏感的，T和t是有区别的。
保留字: and, break, do, else, elseif, end, false, for, function, if, in, local, nil, not, or, repeat, return, then, true, until, while

字符串
----
包含在'或"之中， 转义字符(\)
[[]]: 避免清理引号关系
message = [['That's "Jack O'Neil", with two ll's]]
message = [=[One]=]

数字
----
print(5)        //5         小数数字
print(5.3)      //5.3       浮点型数字
print(5.31e-2)  // 0.0531   科学技术数字
print(0xfeed)   //65261     十六进制数字

变量
----
1. nil = null, 
2. boolean 
3. number
4. string
5. function
6. userdata, 不能再lua中创建和操作，只能通过C的API使用。
7. thread(线程)
8. table, 数组，关联数组，哈希表，集合(Sets)，记录(Records)，列表(Lists)，树(Trees)，对象

块和作用域
----
* 变量分为全局变量和局部变量，默认情况下定义为全局变量。
* 在do和end中定义的变量无法再外部访问，在外部定义的变量也无法再内部访问
* 强制转换，a = "1", b = 2, c = a+b, c=3

算数运算符
----
* + 相加 
* - 相减
* * 相乘
* / 相除
* % 求余
* ^ 指数
* - 负数

关系运算符
----
* == 等于
* ~= 不等于
* < 小于
* > 大于
* <= 小于等于
* >= 大于等于

逻辑运算符
----
* and
* or
* not

其它运算符
----
* .. 连接符 print("one, two, ".." buckle my shoe")
* # 长度运算符 print(#"this is a long string") //21
