var request = require("request");$

var url = "http://realusionapi.87vr.com/session_info.php?id=05l5rvjurialsidqv9064tfbq6";
request(
    {
        method: 'GET',
        uri: url,
    },
    function(error, response, body){
    //    console.log('server encoded the data as: ' + (response.headers['content-encoding'] || 'identity'));
    //    console.log('the decoded data is: '+body);
    }
).on('data', function(data){
    console.log('decoded chunk: ' + data);
});
