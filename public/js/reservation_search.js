$(document).ready(function () {
    $("input[name='begin_date']").on("input", function () {
        $("input[name='end_date']").prop(
            "min",
            $("input[name='begin_date']").val()
        );
    });

    $("input[name='end_date']").on("input", function () {
        $("input[name='begin_date']").prop(
            "max",
            $("input[name='end_date']").val()
        );
    });

    $("input[name='begin_date']").trigger("input");
    $("input[name='end_date']").trigger("input");
});
