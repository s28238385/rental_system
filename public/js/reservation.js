$(document).ready(function () {
    //修正網址
    url = location.href.split("/");
    if (url[4] == "new" && url.slice(-1) != "new") {
        history.replaceState("", "", "/reservation/new");
    }

    //預約種類改變時
    $("input[name='reservation_type']").click(function () {
        if (
            $("input[name='reservation_type']:checked").val() === "short_term"
        ) {
            //更改小標名稱
            $("label[for='begin-date']").text("借用日期");
            //隱藏結束日期，取消required
            $("#end-date").prop("required", false).parent().addClass("d-none");
            //隱藏重複星期選項
            $("#loop-day").parent().parent().addClass("d-none");

            $("#begin-date, #end-date").trigger("input");
        } else if (
            $("input[name='reservation_type']:checked").val() === "long_term"
        ) {
            //更改小標名稱
            $("label[for='begin-date']").text("開始日期");
            //顯示結束日期，設定required
            $("#end-date")
                .prop("required", true)
                .parent()
                .removeClass("d-none");
            //顯示重複星期選項
            $("#loop-day").parent().parent().removeClass("d-none");

            $("#begin-date, #end-date").trigger("input");
        }
    });

    $("#begin-date").on("input", function () {
        if ($("input[name='reservation_type']:checked").val() == "long_term") {
            $("#end-date").prop("min", $("#begin-date").val());
        } else {
            $("#end-date").removeAttr("min");
        }
    });

    $("#end-date").on("input", function () {
        if (
            $("input[name='reservation_type']:checked").val() == "long_term" &&
            $("#end-date").val() != ""
        ) {
            $("#begin-date").prop("max", $("#end-date").val());
        } else {
            $("#begin-date").prop("max", "9999-12-31");
        }
    });

    $("form").submit(function () {
        if (
            $("#phone").val() != "" &&
            !$("#phone")
                .val()
                .match(/^09\d{8}$/) &&
            !$("#phone")
                .val()
                .match(/^\d{5}$/)
        ) {
            alert("聯絡電話格式不符");

            return false;
        }

        if (
            $("input[name='reservation_type']:checked").val() == "long_term" &&
            $("#loop-day").find("input:checked").length == 0
        ) {
            alert("請選擇重複時間");

            return false;
        }

        if (
            $("#begin-time option:selected").text().slice(0, 2) >
            $("#end-time option:selected").text().slice(0, 2)
        ) {
            alert("開始時間必須比結束時間早");

            return false;
        }
    });
});
