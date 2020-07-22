/** 在 calender.blade.php 中，引入此 js 檔需在引入 calender.js 之後 */

// $('document').ready(function(){
//     //let date = "7/16";

//     //let test = $('#Sun-12').parent().siblings('.calender-data').children('#Sun').text()
//     let test = $('#Sun').text();
//     console.log(test);
// });

$('document').ready(function(){
    // for post method
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });    
    
    function get_reservation(classroom,date){
        $.ajax({
            url:'/statusCalender',
            method:'GET',
            data:{classroom:classroom,date:date},
            dataType:'json',
            success:function(data){
                //console.log("ajax success");
                //console.log(data.name);
                $('.show_res').append(data.reason);
                //$("td[headers='Mon']").html(data.name+"<br/>"+data.reason);
            }
        })
    }
    //the ajax test botton
    $('.show_res').click(function(){
        //classroom name 字串處理
        let chosen_status = $('.active').attr("id");
        let arr_name = chosen_status.split('-');
        let classroom = arr_name[0];

        //date 字串處理
        //console.log($('#Sun').html());
        let cal_header = $('#Sun').html();
        let arr_date_1 = cal_header.split("<br>"); //年<br/>月/日<br/>星期
        let arr_date_2 = arr_date_1[1].split("/");//月/日
        
        //let date = arr_date_1[0] + "-" + arr_date_2[0] + "-" + arr_date_2[1];
        //console.log(date);

        //let date = Date(arr_date_1[0],arr_date_2[0]-1,arr_date_2[1])

        console.log(classroom+" "+date);
        get_reservation(classroom,date);
        //$('#Sun-12').html("success");

        //$("td[headers='Monday']").html(test);
        //console.log(test);
        
    })
});

