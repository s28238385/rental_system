$(document).ready(function () {
    $("#genre").change(function () {
        $("#item").children().remove().end();

        if ($("#genre option:selected").text() != "請選擇種類") {
            Object.keys(equipments[$("#genre option:selected").text()]).forEach(
                (element) => {
                    $("#item").append(
                        new Option(
                            equipments[$("#genre option:selected").text()][
                                element
                            ]
                        )
                    );
                }
            );
        }
    });

    $("#genre").change();

    if (oldItem != null) {
        $("#item option:contains(" + oldItem + ")").prop("selected", true);
    }

    $("form").submit(function () {
        if ($("#item option:selected").text() === "") {
            alert("請選擇設備種類及項目");

            return false;
        }
    });
});
