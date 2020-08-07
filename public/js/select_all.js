$("document").ready(function () {
    $("#all").click(function () {
        if ($("#all").is(":checked")) {
            $("input[type='checkbox']").prop("checked", true);
        } else {
            $("input[type='checkbox']").prop("checked", false);
        }
    });
});
