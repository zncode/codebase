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

9. load(func[, chunkname])
类似dofile，chunkname=调试信息

10. loadstring(string[, chunkname])
从字符串中获取编译完成的代码块
loadstring(compiliedChunk, "OurChunk")

11. next(table[, index])
遍历表的所有字段，返回多个值。
t = {"one", "Deux", "Drei", "Quarto"}
print(next(t, 3))

12. pairs(t)
遍历表所有键名和值
t = {one = "Eins", two = "Zwei", three = "Drei"}
for k,v in pairs(t) do
-- body
  print(k, v)
end

13. pcall(f, arg1, ...)
在保护模式下调用f函数，内部错误不会暴露到外部。

14. print(...)
打印函数

15. rawqual(v1, v2)
判断v1 是否等于 v2 返回布尔值

16. rawget(table, index)
调用table[index]值，不会调用任何元表的方法。

17. rawset(table, index, value)
设置table[index]值

18. select(index, ...)
返回传入参数中所有索引大于index的参数

19. setfenv(f, table)
设定f函数的环境表。f可以是lua函数或是特定的平台数值。

20. setmetatable(table, metatable)
给任何表设置元表

21. tonumber(e[, base])
将字符串转成数字
print(tonumber("42"))
print(tonumber("2A", 16))

22. tostring(e)
将数字转换成字符串

23. type(v)
返回参数类型

24. unpack(list[i, [, j]])
函数返回数组表的元素
i: 起始元素，默认1
j: 终止元素，默认#（总长度）

25. _VERSION
记录当前解释器的版本

26. xpcall(f, err)
同pcall，但是可以自定义返回信息。xpcall会将其捕获并用原错误对象反向调用err函数。




