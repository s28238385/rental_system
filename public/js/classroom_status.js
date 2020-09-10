/* 引入此 js 檔需在引入 calender.js 之後 */
let course = [
    "1",
    "2",
    "3",
    "4",
    "Z",
    "5",
    "6",
    "7",
    "8",
    "9",
    "A",
    "B",
    "C",
    "D",
]; //節次
let week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

//取得ajax
function getAjax() {
    //classroom name 字串處理
    let classroom = $("#chosen_status").val().slice(1);

    let date = $("#Sun")
        .html() //年<br>月/日<br>星期
        .replace("<br>", "/") //年/月/日<br>星期
        .slice(0, -7);

    //送出ajax查詢
    $.ajax({
        url: url,
        method: "GET",
        data: {
            classroom: classroom,
            date: date,
        },
        dataType: "json",
        //查詢成功時
        success: function (data) {
            $("td[id*='-']").html(""); //清空calender
            let reservations = data.data; //取出預約資料

            //若有預約存在
            if (reservations.length != 0) {
                //判斷在總覽頁籤或是教室頁籤
                if (classroom === "All") {
                    //依序填入所有預約
                    reservations.forEach((element) => {
                        let day = new Date(element["date"]);

                        for (
                            let i = element["begin_time"];
                            i <= element["end_time"];
                            i++
                        ) {
                            $("#" + week[day.getDay()] + "-" + course[i]).html(
                                $(
                                    "#" + week[day.getDay()] + "-" + course[i]
                                ).html() +
                                    "<p class='text-break m-1 px-2 py-1 bg-green rounded-sm'>" +
                                    element["classroom"] +
                                    "<br>" +
                                    element["reason"] +
                                    "</p>"
                            );
                        }
                    });
                } else {
                    //依序填入所有預約
                    reservations.forEach((element) => {
                        let day = new Date(element["date"]);
                        for (
                            let i = element["begin_time"];
                            i <= element["end_time"];
                            i++
                        ) {
                            $("#" + week[day.getDay()] + "-" + course[i]).html(
                                $(
                                    "#" + week[day.getDay()] + "-" + course[i]
                                ).html() +
                                    "<p class='text-break m-1 px-2 py-1 bg-green rounded-sm'>" +
                                    element["reason"] +
                                    "<br>" +
                                    element["name"] +
                                    "</p>"
                            );
                        }
                    });
                }
            }
        },
        //查詢失敗時
        error: function () {
            $("td[id*='-']").html(""); //清空calender
            //查詢失敗的該日每格皆填入擷取失敗
            $("td").each(function () {
                $(this).html("擷取失敗");
            });
        },
    });
}

$("document").ready(function () {
    //建立教室選擇的頁籤
    $("#classroom-tabs").tabs();

    //點選教室頁籤時
    $("a[id$='-tab']").click(function () {
        //判斷在總覽頁籤或是教室頁籤，設定選擇中的內容
        if ($(this).text() === "總覽") {
            $("#chosen_status").val("#All");
        } else {
            $("#chosen_status").val("#" + $(this).text());
        }
        //移除所有頁籤的.active
        $("a[id$='-tab']").removeClass("active");
        //將選中的頁籤加上.active
        $("a[href='" + $("#chosen_status").val() + "']").addClass("active");

        //取得預約資料
        getAjax();
    });

    // 上一週
    $("#toPreviousWeek").click(function () {
        //取得預約資料
        getAjax();
    });

    // 回本週
    $("#toThisWeek").click(function () {
        //取得預約資料
        getAjax();
    });

    // 下一週
    $("#toNextWeek").click(function () {
        //取得預約資料
        getAjax();
    });

    // 前往指定日期
    $("#toCertainWeek").click(function () {
        if ($("#date-select").val() != "") {
            //取得預約資料
            getAjax();
        }
    });

    if ((firstDay != "") & (classroom != "null")) {
        $("#chosen_status").val("#" + classroom);
        $("#date-select").val(firstDay);

        $("a[href='" + $("#chosen_status").val() + "']").click();
        $("#toCertainWeek").click();
    } else {
        //剛載入頁面時先顯示總覽頁籤
        $("a[href='" + $("#chosen_status").val() + "']").click();
    }
});
