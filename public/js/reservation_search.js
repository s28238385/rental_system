$(document).ready(function () {
    //begin_date選擇後設定end_date的最早日期
    $("input[name='begin_date']").on("input", function () {
        $("input[name='end_date']").prop(
            "min",
            $("input[name='begin_date']").val()
        );
    });

    //end_date選擇後設定begin_date的最晚日期
    $("input[name='end_date']").on("input", function () {
        if ($("input[name='end_date']").val() != "") {
            $("input[name='begin_date']").prop(
                "max",
                $("input[name='end_date']").val()
            );
        }
    });

    //觸發一次最大最小值設定，讓查詢完的搜尋列可正常顯示最早及最晚日期
    $("input[name='begin_date']").trigger("input");
    $("input[name='end_date']").trigger("input");
});
