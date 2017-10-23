#coding:utf-8
import pymysql.cursors
import csv
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

# 连接数据库
connect = pymysql.Connect(
    host='47.93.245.187',
    port=3306,
    user='qijixue',
    passwd='qijixue!@#',
    db='learning_system',
    charset='utf8'
)

# 获取游标
cursor = connect.cursor()

# 查询数据
sql = "SELECT c_id, s_id FROM t_stu_course_chapters where end_time > '2017-06-01 00:00:00' and end_time < '2017-11-30 00:00:00' and status = 2 group by s_id"
data = []
cursor.execute(sql)
for row in cursor.fetchall():
	c_id = row[0]
	s_id = row[1]

	sql = "SELECT c_name from t_com_course where c_id = " + bytes(c_id)
	cursor.execute(sql)
	c_name = cursor.fetchone()
	c_name = c_name[0]
	sql = "SELECT true_name, mobile from t_user where u_id = " + bytes(s_id)
	cursor.execute(sql)
	user = cursor.fetchone()
	# print true_name[0]
	if user is None:
		true_name = 'empty'
		mobile = 'empty'
	else:
		true_name = user[0]
		mobile = user[1]
	
	sql = "SELECT count(id) as sum_chapters from t_stu_course_chapters where s_id = " + bytes(s_id) + " and c_id = " + bytes(c_id)
	cursor.execute(sql)
	stuChapter = cursor.fetchone()
	if stuChapter is None:
		sumChapters = 'empty'
	else:
		sumChapters = stuChapter[0]
	
	sql = "SELECT status, pay_state as sum_chapters, start_time, end_time from t_stu_course where s_id = " + bytes(s_id) + " and c_id = " + bytes(c_id)
	cursor.execute(sql)
	stuCourse = cursor.fetchone()
	if stuCourse is None:
		status = '';
		pay_state = '';
	else:
		status = stuCourse[0]
		pay_state = stuCourse[1]
		start_time = stuCourse[2]
		end_time = stuCourse[3]
		if status == 1:
			status = '已购买'
		elif status == 2:
			status = '正在学习'
		elif status == 3:
			status = '已学完'
		elif status == 4:
			status = '课程已冻结'

		if pay_state == 1:
			pay_state = '体验'
		elif pay_state == 2:
			pay_state = '首付'
		elif pay_state == 3:
			pay_state = '全部支付'
		elif pay_state == 4:
			pay_state = '续费'

	sql = "SELECT count(id) as sum_finish_chapters from t_stu_course_chapters where s_id = " + bytes(s_id) + " and c_id = " + bytes(c_id) + ' and status = 2'
	cursor.execute(sql)
	stuChapter = cursor.fetchone()
	if stuChapter is None:
		sumFinishChapters = 'empty'
	else:
		sumFinishChapters = stuChapter[0]

	sumSurplusChapters = sumChapters - sumFinishChapters
 	a = [true_name, mobile, c_name, status, pay_state, sumChapters, sumFinishChapters, sumSurplusChapters, start_time, end_time]
 	data.append(a)

title = ['姓名', '手机号', '课程名称', '状态', '付费方式','总章节','完成章节','剩余章节', '课程开始时间', '课程结束时间']


with open('data.csv', 'wb') as ff:
	writer = csv.writer(ff, dialect="excel")
	writer.writerow(title)
	writer.writerows(data)

# 关闭连接
cursor.close()
connect.close()
