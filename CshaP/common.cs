using System;
using System.IO;
using Newtonsoft.Json;

//读取本地文件
string filename = Vercoop.Config.GetDataDirectory() + System.IO.Path.DirectorySeparatorChar + "content.json";
String jsonp = System.IO.File.ReadAllText(filename);

//读取json数据
var datas = JsonConvert.DeserializeObject(jsonp);

//对象转数组
var datasArray = (JArray)datas;

//循环数组
foreach (JToken token in datasArray)
{
    string ct_idx = token["ct_idx"].ToString();
} 

//字符串转整型
int idx = Int32.Parse(ct_idx);
