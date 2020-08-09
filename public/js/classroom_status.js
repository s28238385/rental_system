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

//取得查詢資料
function get_reservation(classroom, date, day) {
    //送出ajax查詢
    $.ajax({
        url: url,
        method: "POST",
        data: {
            classroom: classroom,
            date: date,
            _token: token,
        },
        dataType: "json",
        //查詢成功時
        success: function (data) {
            let reservations = data.data; //取出預約資料

            //若有預約存在
            if (reservations.length != 0) {
                //判斷在總覽頁籤或是教室頁籤
                if (classroom === "#All") {
                    //依序填入所有預約
                    for (let key in reservations) {
                        for (
                            let i = reservations[key]["begin_time"];
                            i <= reservations[key]["end_time"];
                            i++
                        ) {
                            $("#" + day + "-" + course[i]).html(
                                $("#" + day + "-" + course[i]).html() +
                                    "<p class='text-break m-1 px-2 py-1 bg-green rounded-sm'>" +
                                    reservations[key]["classroom"] +
                                    "<br>" +
                                    reservations[key]["name"] +
                                    "</p>"
                            );
                        }
                    }
                } else {
                    //依序填入所有預約
                    for (let key in reservations) {
                        for (
                            let i = reservations[key]["begin_time"];
                            i <= reservations[key]["end_time"];
                            i++
                        ) {
                            $("#" + day + "-" + course[i]).html(
                                "<p class='text-break m-1 px-2 py-1 bg-green rounded-sm'>" +
                                    reservations[key]["name"] +
                                    "<br>" +
                                    reservations[key]["reason"] +
                                    "</p>"
                            );
                        }
                    }
                }
            }

            //若是填入至星期六則表示已經完成填入，隱藏loading圖樣
            if (day === "Sat") {
                $("#loaderModal").modal("hide");
            }
        },
        //查詢失敗時
        error: function () {
            //查詢失敗的該日每格皆填入擷取失敗
            $("td[id^='" + day + "-']").html("擷取失敗");

            //若是填入至星期六則表示已經完成填入，隱藏loading圖樣
            if (day === "Sat") {
                $("#loaderModal").modal("hide");
            }
        },
    });
}

//取得ajax
function getAjax() {
    //顯示載入圖樣
    $("#loaderModal").modal("show");

    //classroom name 字串處理
    let classroom = $(".active")
        .attr("id") // classroom-tab
        .slice(0, -4); //移除-tab

    $("td[id*='-']").html(""); //清空calender

    $(".calender-data")
        .children()
        .each(function () {
            //date字串處理
            let date = $(this)
                .html() //年<br>月/日<br>星期
                .replace("<br>", "/") //年/月/日<br>星期
                .slice(0, -7);

            let day = $(this).attr("id");

            //time 是放時間的行
            if (day != "time") {
                get_reservation(classroom, date, day);
            }
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

    //剛載入頁面時先顯示總覽頁籤
    $("a[href='" + $("#chosen_status").val() + "']").click();
});
