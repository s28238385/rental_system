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
];

function get_reservation(classroom, date, day) {
    $.ajax({
        url: url,
        method: "POST",
        data: {
            classroom: classroom,
            date: date,
            _token: token,
        },
        dataType: "json",
        success: function (data) {
            let reservations = data.data;
            console.log(reservations);

            if (reservations.length != 0) {
                if (classroom === "#All") {
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

            if (day === "Sat") {
                $("#loaderModal").modal("hide");
            }
        },
        error: function () {
            $("td[id^='" + day + "-']").html("擷取失敗");

            if (day === "Sat") {
                $("#loaderModal").modal("hide");
            }
        },
    });
}

function getAjax() {
    $("#loaderModal").modal("show");

    //classroom name 字串處理
    let classroom = $(".active")
        .attr("id") // classroom-tab
        .slice(0, -4); //移除-tab
    console.log(classroom);

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

            if (day != "time") {
                get_reservation(classroom, date, day);
            }
        });
}

$("document").ready(function () {
    $("#classroom-tabs").tabs();

    $("a[id$='-tab']").click(function () {
        if ($(this).text() === "總覽") {
            $("#chosen_status").val("#All");
        } else {
            $("#chosen_status").val("#" + $(this).text());
        }
        $("a[id$='-tab']").removeClass("active");
        $("a[href='" + $("#chosen_status").val() + "']").addClass("active");
        getAjax();
    });

    $("a[href='" + $("#chosen_status").val() + "']").click();

    // 上一週
    $("#toPreviousWeek").click(function () {
        getAjax();
    });

    // 回本週
    $("#toThisWeek").click(function () {
        getAjax();
    });

    // 下一週
    $("#toNextWeek").click(function () {
        getAjax();
    });

    // 前往指定日期
    $("#toCertainWeek").click(function () {
        getAjax();
    });
});
