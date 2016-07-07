var mysql = require('mysql');

var connection = mysql.createConnection({
    host: 'rdsmcaz1q7ij010idl7kpublic.mysql.rds.aliyuncs.com',
    user: 'realusion',
    password: 'A1@3785abc9#1',
    port: '3306',
});

connection.connect(function(error){
    if(error)
    {
        console.log('[query] - :' + error);
        return;
    }
    console.log('[connection connect] succeed!');
});

connection.query("select * from vcdata_session.realusion_session where sSessionKey = '05l5rvjurialsidqv9064tfbq6' ", function(err, rows, fields){
    if(err){
        console.log('[query] - :' + err)
    }
    var sValue = rows[0].sSessionValue;
    var sValueObj = unserialize(sValue);
  //      console.log('aa'+sValueObj);
    //var mIdx = sValueObj.gr_member_idx;

    console.log('The sSessionValue is: ', sValue);
    //console.log('member idx: : ', mIdx);
    
});

connection.end(function(err){
    if(err)
    {
        return;
    }
    console.log('[connection end] succeed!');
});
