$(document).ready(function () {
    $("#genre").change(function () {
        if ($("#genre option:selected").text() === "新增設備種類") {
            $("#genreOther").removeClass("d-none").prop("required", true);
        } else {
            $("#genreOther").addClass("d-none").prop("required", false);
        }
    });

    $("form").submit(function () {
        if ($("#genre option:selected").text() === "新增設備種類") {
            if ($.trim($("#genreOther").val()) === "") {
                alert("新增的設備種類不可為空白");

                return false;
            }
        }
    });
});
