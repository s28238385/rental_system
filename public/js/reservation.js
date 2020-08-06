$(document).ready(function () {
    $("input[name='reservation_type']").click(function () {
        if (
            $("input[name='reservation_type']:checked").val() === "short_term"
        ) {
            $("label[for='begin-date']").text("借用日期");
            $("#end-date").prop("required", false).parent().addClass("d-none");
            $("#loop-day").parent().parent().addClass("d-none");
        } else if (
            $("input[name='reservation_type']:checked").val() === "long_term"
        ) {
            $("label[for='begin-date']").text("開始日期");
            $("#end-date")
                .prop("required", true)
                .parent()
                .removeClass("d-none");
            $("#loop-day").parent().parent().removeClass("d-none");
        }
    });
});
