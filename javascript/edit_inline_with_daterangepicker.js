 table.on( 'click', '.my_class', function () {
        var tdObj = $(this);  
        var text = tdObj.html();  
        var columns = table.row( $(this).parents('tr') ).data();
        var id = columns[0];
        tdObj.html("");  
        var inputObj = $("<input type='text'>").css("border-width", "0").css("font-size", "15px").width(tdObj.width()).val(text).appendTo(tdObj).daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
                dateLimit : {
                    days : 999
                }, //起止时间的最大间隔
                showDropdowns : true,
                showWeekNumbers : false, //是否显示第几周
                timePicker : true, //是否显示小时和分钟
                timePickerIncrement : 1, //时间的增量，单位为分钟
                timePicker24Hour : true, //是否使用12小时制来显示时间
                opens : 'right', //日期选择框的弹出位置
                buttonClasses : [ 'btn btn-default' ],
                applyClass : 'btn-small btn-primary blue',
                cancelClass : 'btn-small',
                separator : ' to ',
                locale : {
                    applyLabel : '确定',
                    cancelLabel : '取消',
                    fromLabel : '起始时间',
                    toLabel : '结束时间',
                    customRangeLabel : '自定义',
                    daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                    firstDay : 1,
                    "format": "YYYY-MM-DD HH:mm:ss",
                }
        }, function(start, end, label) {
            var datetime = start.format('YYYY-MM-DD HH:mm:ss');
            var data = {};
            data.datetime = datetime;
            data.id  = id;
            $.ajax({
                url: '/games/audit/update_onlinedate_submit',
                type: 'POST',
                data: data,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            });
            tdObj.html(datetime);
        });  
        //是文本框插入之后被选中  
        inputObj.get(0).select();  
        inputObj.click(function () {  
            return false;  
        });  
      //  inputObj.mouseleave(function(){
      //      var inputtext = $(this).val();  
      //      tdObj.html(inputtext);  
      //  });
        //处理文本框上回车和esc按键的操作  
        inputObj.keyup(function (event) {  
            //获取当前按下键盘的键值  
            //处理回车的情况  
            var keycode = event.which  
            if (keycode == 13) {  
                var inputtext = $(this).val();  
                tdObj.html(inputtext);  
            }  
            if (keycode == 27) {  
                tdObj.html(text);  
            }  
        }); 
    }); 
