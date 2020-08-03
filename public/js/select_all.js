$("document").ready(function () {
    $("#all").click(function () {
        if ($("#all").is(":checked")) {
            $("input[id^='rent']").prop("checked", true);
        } else {
            $("input[id^='rent']").prop("checked", false);
        }
    });
});
