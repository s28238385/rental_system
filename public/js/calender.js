//填入該周 年/月/日 星期
function fillInDates(sun) {
    let weekTraverse = new Date(sun);

    $("#Sun").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（日）"
    );
    weekTraverse.addDay(1);
    $("#Mon").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（一）"
    );
    weekTraverse.addDay(1);
    $("#Tue").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（二）"
    );
    weekTraverse.addDay(1);
    $("#Wed").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（三）"
    );
    weekTraverse.addDay(1);
    $("#Thu").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（四）"
    );
    weekTraverse.addDay(1);
    $("#Fri").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（五）"
    );
    weekTraverse.addDay(1);
    $("#Sat").html(
        weekTraverse.getFullYear() +
            "<br>" +
            (weekTraverse.getMonth() + 1) +
            "/" +
            weekTraverse.getDate() +
            "<br>（六）"
    );
}

//宣告新的date function
//增減日期
Date.prototype.addDay = function (days) {
    this.setDate(this.getDate() + days);

    return this;
};

//取得該周的星期日
Date.prototype.getSunday = function () {
    let day = this.getDay();

    switch (day) {
        case 0:
            break;
        case 1:
            this.addDay(-1);
            break;

        case 2:
            this.addDay(-2);
            break;

        case 3:
            this.addDay(-3);
            break;

        case 4:
            this.addDay(-4);
            break;

        case 5:
            this.addDay(-5);
            break;

        case 6:
            this.addDay(-6);
            break;
    }
};

$("document").ready(function () {
    let sundayOfShowingWeek = new Date(); //顯示周的星期日

    //剛載入頁面時顯示當周
    sundayOfShowingWeek.setTime(Date.now());
    sundayOfShowingWeek.getSunday();

    fillInDates(sundayOfShowingWeek);

    //點選上一周時
    $("#toPreviousWeek").click(function () {
        sundayOfShowingWeek.addDay(-7);

        fillInDates(sundayOfShowingWeek);
    });

    //點選回本周時
    $("#toThisWeek").click(function () {
        sundayOfShowingWeek.setTime(Date.now());
        sundayOfShowingWeek.getSunday();

        fillInDates(sundayOfShowingWeek);
    });

    //點選下一周時
    $("#toNextWeek").click(function () {
        sundayOfShowingWeek.addDay(7);

        fillInDates(sundayOfShowingWeek);
    });

    //點選前往時
    $("#toCertainWeek").click(function () {
        if ($("#date-select").val() != "") {
            sundayOfShowingWeek = new Date($("#date-select").val());
            sundayOfShowingWeek.getSunday();

            fillInDates(sundayOfShowingWeek);
        } else {
            alert("沒有填入要前往的日期");
        }
    });
});
