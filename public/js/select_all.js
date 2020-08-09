$("document").ready(function () {
    //全部借出/全部歸還點選時
    $("#all").click(function () {
        //根據勾選與否將底下所有借出/歸還鈕勾選/取消勾選
        if ($("#all").is(":checked")) {
            $("input[type='checkbox']").prop("checked", true);
        } else {
            $("input[type='checkbox']").prop("checked", false);
        }
    });
});
