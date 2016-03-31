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
