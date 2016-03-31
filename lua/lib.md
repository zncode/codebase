基础函数
===========

1. assert(v[, message])
如果表达式v=假，显示message

2. collectgarbage([opt [, arg]])
垃圾收集器通用接口。
print(collectgarbage("count")) 输出清理后的内存使用情况。

3. dofile(filename)
执行指定文件

4. error(message[, level])
终止正在执行的函数, 同时将message值作为错误信息返回。

5. _G
全局变量，记录所有全局变量和函数

6. getfenv([f])
返回函数当前环境。
f: 可以是一个lua函数或者数字

7. getmetatable
返回对象相关元表，如果没有返回nil。如果type函数返回信息有限，则使用getmetatable。

8. ipairs(t)
迭代函数，参数只能是数组表。返回3个值，迭代函数、表t和0
for有2种用法
第一种是 for i = 1,10,1 do print(i) end 这种 当计数器用的
第二种是泛型for a,b,c,d,e in fun1(para) do ... end



