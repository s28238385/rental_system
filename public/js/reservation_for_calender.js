/** 引入此 js 檔需在引入 calender.js 之後 */

// $('document').ready(function(){
//     //let date = "7/16";

//     //let test = $('#Sun-12').parent().siblings('.calender-data').children('#Sun').text()
//     let test = $('#Sun').text();
//     console.log(test);
// });

$('document').ready(function(){

    function get_reservation(classroom,date){
        $.ajax({
            url:'/statusCalender',
            method:'GET',
            data:{classroom:classroom,date:date},
            dataType:'json',
            success:function(data){
                console.log(data.classroom + " ajax success."); //test
                
                $('.show_res').append(data.reason);
                //$("td[headers='Mon']").html(data.name+"<br/>"+data.reason);
            }
        })
    }
    // the ajax test botton
    $('.show_res').click(function(){
        //classroom name 字串處理
        let chosen_status = $('.active').attr("id");
        let arr_name = chosen_status.split('-');
        let classroom = arr_name[0];

        // date 字串處理
        let cal_header = $('#Sun').html();
        let arr_date_1 = cal_header.split("<br>"); //年<br>月/日<br>星期
        let arr_date_2 = arr_date_1[1].split("/");//月/日
        
        // pad成mm/dd格式
        arr_date_2[0] = arr_date_2[0].padStart(2, "0");
        arr_date_2[1] = arr_date_2[1].padStart(2, "0");
        
        let date = arr_date_1[0] + "-" + arr_date_2[0] + "-" + arr_date_2[1];

        console.log(classroom+" "+date); //test
        get_reservation(classroom,date);
        //$('#Sun-12').html("success");

    })
});

