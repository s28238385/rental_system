/** 引入此 js 檔需在引入 calender.js 之後 */

function get_reservation(classroom,date,period,day){
    $.ajax({
        url:'/statusCalender',
        method:'GET',
        data:{classroom:classroom,date:date,period:period,day:day},
        dataType:'json',
        success:function(data){
            //console.log("user: " + data.name + ". for: " + data.reason + ". current time: "+data.currentTime); //test
            
            if (data.name && data.reason) {// 若回傳不為空
                $("td[headers='"+day+"']#"+day+"-"+period).html(data.name+"<br/>"+data.reason);
                // ex. $("td[headers='Sun']#Sun-8")
            }else{
                $("td[headers='"+day+"']#"+day+"-"+period).html("");
            }

            if (data.loadEnd == 1) {
                $('#loaderModal').modal('hide');
            }
        }
    })
}

function get_each_day(day){
    //遍歷day的節次
    $("td[id^='"+day+"-']").each(function(){
        // 取得當前單元格的節次
        let period = $(this).attr('id');
        let arr_period = period.split('-');// Day-Period
        period = arr_period[1];

        //classroom name 字串處理
        let chosen_status = $('.active').attr("id");
        let arr_name = chosen_status.split('-');// classroomName-tab
        let classroom = arr_name[0];

        // date 字串處理
        let cal_header = $('#'+day+'').html();
        let arr_date_1 = cal_header.split("<br>"); //年<br>月/日<br>星期
        let arr_date_2 = arr_date_1[1].split("/");//月/日
        // pad成mm/dd格式
        arr_date_2[0] = arr_date_2[0].padStart(2, "0");
        arr_date_2[1] = arr_date_2[1].padStart(2, "0");
        // 串接成與資料表格式相符的date
        let date = arr_date_1[0] + "-" + arr_date_2[0] + "-" + arr_date_2[1];
        
        //console.log("classroom: "+classroom+". date: "+date+". period: "+period); //test
        get_reservation(classroom,date,period,day);
    })
}

function get_start() {
    $('#loaderModal').modal('show');

    let Sun = "Sun";
    let Mon = "Mon";
    let Tue = "Tue";
    let Wed = "Wed";
    let Thu = "Thu";
    let Fri = "Fri";
    let Sat = "Sat";

    get_each_day(Sun);
    get_each_day(Mon);
    get_each_day(Tue);
    get_each_day(Wed);
    get_each_day(Thu);
    get_each_day(Fri);
    get_each_day(Sat);
}

$('document').ready(function(){
    get_start();// load the page

    // test button
    // $('.show_res').click(function(){
    //     get_start();
    // })

    // 切換教室tab
    $('.nav-tabs a').click(function(){
        get_start();
    })

    // 上一週
    $('#toPreviousWeek').click(function(){
        get_start();
    })

    // 回本週
    $('#toThisWeek').click(function(){
        get_start();
    })

    // 下一週
    $('#toNextWeek').click(function(){
        get_start();
    })

    // 前往指定日期
    $('#toCertainWeek').click(function(){
        get_start();
    })

    
});

