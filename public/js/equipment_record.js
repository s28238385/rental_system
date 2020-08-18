$(document).ready(function () {
    //查詢的設備種類改變時
    $("#genre").change(function () {
        //清除#item內的所有option
        $("#item").children().remove().end();

        //調入option至#item
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

    //觸發一次讓查詢過的資料可以顯示
    $("#genre").change();

    //將舊資料填入
    if (oldItem != null) {
        $("#item option:contains(" + oldItem + ")").prop("selected", true);
    }

    //表單送出檢查
    $("form").submit(function () {
        if ($("#item option:selected").text() === "") {
            alert("請選擇設備種類及項目");

            return false;
        }
    });
});
