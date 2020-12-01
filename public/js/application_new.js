$("document").ready(function () {
    let equipmentNum = 0; //設備借用編號
    let genrekey, itemkey;

    //閱讀規則後彈出借用表單
    $("#agreeBtn").click(function () {
        $("#ruleSection").remove();
        $("#formSection").toggleClass("d-none");
    });

    //身分改變時
    $("#identity").change(() => {
        //分機/手機、隱藏系級、抵押證件與否
        if ($("#identity option:selected").text() === "學生") {
            $("#gradePart, #cardPart").removeClass("d-none");
            $("#grade").prop("required", true);
            $('label[for="phone"]').children(".text").text("手機號碼");
            //手機號碼格式檢查
            if (
                $("#phone").val() != "" &&
                !$("#phone")
                    .val()
                    .match(/^09\d{8}$/)
            ) {
                $("#phone").addClass("is-invalid");
            } else {
                $("#phone").removeClass("is-invalid");
            }
            $("#certificate").change();
        } else {
            $("#gradePart, #cardPart").addClass("d-none");
            $("#grade").prop("required", false);
            $('label[for="phone"]').children(".text").text("分機");
            //分機格式檢查
            if (
                $("#phone").val() != "" &&
                !$("#phone")
                    .val()
                    .match(/^\d{5}$/)
            ) {
                $("#phone").addClass("is-invalid");
            } else {
                $("#phone").removeClass("is-invalid");
            }
        }
    });

    //抵押證件選項改變時決定是否顯示額外的輸入欄
    $("#certificate").change(function () {
        if ($("#certificate option:selected").text() === "其他") {
            //更改版面配置與填入required
            $("#certificate")
                .parent()
                .removeClass("col-md-12")
                .addClass("col-md-4");
            $("#certificateOther").prop("required", true).removeClass("d-none");
        } else {
            //取消required與更改版面配置
            $("#certificateOther").prop("required", false).addClass("d-none");
            $("#certificate")
                .parent()
                .removeClass("col-md-4")
                .addClass("col-md-12");
        }
    });

    //輸入手機/分機號碼時做格式檢查
    $("#phone").on("input", () => {
        if ($("#identity option:selected").text() === "學生") {
            if (
                $("#phone")
                    .val()
                    .match(/^09\d{8}$/)
            ) {
                $("#phone").removeClass("is-invalid");
            } else {
                $("#phone").addClass("is-invalid");
            }
        } else {
            if (
                $("#phone")
                    .val()
                    .match(/^\d{5}$/)
            ) {
                $("#phone").removeClass("is-invalid");
            } else {
                $("#phone").addClass("is-invalid");
            }
        }
    });

    //是否借用教室的核取方塊改變時
    $("#wantRentChk").change(function () {
        $("#classroomSection").toggleClass("d-none");
    });

    //教室改變時
    $("#classroom").change(function () {
        $(this)
            .parents("#classroomSection")
            .find("#key_type option")
            .each(function () {
                if ($(this).text().includes("無庫存")) {
                    $(this).text($(this).text().slice(5));
                }
            });

        if (
            Object.keys(renting_keys).includes(
                $(this).find("option:selected").text()
            )
        ) {
            renting_keys[$(this).find("option:selected").text()].forEach(
                (element) => {
                    $(this)
                        .parents("#classroomSection")
                        .find(
                            "#key_type option:contains(" +
                                element["key_type"] +
                                ")"
                        )
                        .filter(function () {
                            return $(this).text() === element["key_type"];
                        })
                        .prepend("(無庫存)");
                }
            );
        }
    });

    $("#classroom").change();

    //鑰匙用途改變時
    $("#key_usage").change(function () {
        if ($(this).find("option:selected").text() === "系學會") {
            $(this).parent().removeClass("col-md-12").addClass("col-md-5");
            $(this)
                .parents("#classroomSection")
                .find("#key_sub_usage")
                .removeClass("d-none")
                .prop("placeholder", "請填入部名")
                .prop("required", true);
        } else if ($(this).find("option:selected").text() === "其他") {
            $(this).parent().removeClass("col-md-12").addClass("col-md-5");
            $(this)
                .parents("#classroomSection")
                .find("#key_sub_usage")
                .removeClass("d-none")
                .prop("placeholder", "請填入用途")
                .prop("required", true);
        } else {
            $(this).parent().removeClass("col-md-5").addClass("col-md-12");
            $(this)
                .parents("#classroomSection")
                .find("#key_sub_usage")
                .addClass("d-none")
                .prop("required", false);
        }
    });

    //點選刪除時
    $("#dltBtn").click(function () {
        //移除設備表格
        $(this).parents("#equipment").remove();

        //減少設備借用數
        equipmentNum--;

        //重新編號
        let i = 1;
        $(".equipmentContainer")
            .children()
            .each(function () {
                $(this)
                    .find("#equipmentNum")
                    .html("No." + i++);
            });
    });

    //設備種類選項改變時
    $("#genre").change(function () {
        //改變#item內的選項
        //取得#genre選中的值
        genrekey = $(this).find("option:selected").val();
        //清除#item裡所有選項
        $(this).parents("#equipment").find("#item").children().remove().end();
        //#item填入選項
        Object.keys(equipments[genrekey]).forEach((element) =>
            $(this)
                .parents("#equipment")
                .find("#item")
                .append(new Option(element))
        );

        //改變#quantity內的選項
        //取得#item選中的值
        itemkey = $(this)
            .parents("#equipment")
            .find("#item")
            .find("option:selected")
            .val();
        //清除#quantity裡所有選項
        $(this)
            .parents("#equipment")
            .find("#quantity")
            .children()
            .remove()
            .end();
        //#quantity填入選項
        if (equipments[genrekey][itemkey]["quantity"] <= 0) {
            $(this)
                .parents("#equipment")
                .find("#quantity")
                .append(new Option("無庫存"));
        } else {
            for (
                let i = 1;
                i <= equipments[genrekey][itemkey]["quantity"];
                i++
            ) {
                $(this)
                    .parents("#equipment")
                    .find("#quantity")
                    .append(new Option(i));
            }
        }
    });

    //設備項目選擇改變時
    $("#item").change(function () {
        //取得#genre選中的值
        genrekey = $(this)
            .parents("#equipment")
            .find("#genre option:selected")
            .val();
        //取得#item選中的值
        itemkey = $(this).find("option:selected").val();
        //清除#quantity裡所有選項
        $(this)
            .parents("#equipment")
            .find("#quantity")
            .children()
            .remove()
            .end();
        //#quantity填入選項
        if (equipments[genrekey][itemkey]["quantity"] <= 0) {
            $(this)
                .parents("#equipment")
                .find("#quantity")
                .append(new Option("無庫存"));
        } else {
            for (
                let i = 1;
                i <= equipments[genrekey][itemkey]["quantity"];
                i++
            ) {
                $(this)
                    .parents("#equipment")
                    .find("#quantity")
                    .append(new Option(i));
            }
        }
    });

    //用途改變時
    $("#usage").change(function () {
        if ($(this).find("option:selected").text() === "系學會") {
            $(this).parent().removeClass("col-md-12").addClass("col-md-5");
            $(this)
                .parents(".form-row")
                .find("#sub_usage")
                .removeClass("d-none")
                .prop("placeholder", "請填入部名")
                .prop("required", true);
        } else if ($(this).find("option:selected").text() === "其他") {
            $(this).parent().removeClass("col-md-12").addClass("col-md-5");
            $(this)
                .parents(".form-row")
                .find("#sub_usage")
                .removeClass("d-none")
                .prop("placeholder", "請填入用途")
                .prop("required", true);
        } else {
            $(this).parent().removeClass("col-md-5").addClass("col-md-12");
            $(this)
                .parents(".form-row")
                .find("#sub_usage")
                .addClass("d-none")
                .prop("required", false);
        }
    });

    //借用更多設備時，設備資訊的建構
    function equipmentBuildUp(equipment /*jQuery Object*/) {
        //改變#genre內的選項
        //填入#genre的選項
        Object.keys(equipments).forEach((element) =>
            equipment.find("#genre").append(new Option(element))
        );

        //改變#item內的選項
        //取得#genre選中的值
        genrekey = equipment.find("#genre option:selected").val();
        //清空#item選項
        equipment.find("#item").children().remove().end();
        //填入#item的選項
        Object.keys(equipments[genrekey]).forEach((element) =>
            equipment.find("#item").append(new Option(element))
        );

        //改變#quantity內的選項
        //取得#item選中的值
        itemkey = equipment.find("#item option:selected").val();
        //清空#quantity選項
        equipment.find("#quantity").children().remove().end();
        //填入#quantity的選項
        if (equipments[genrekey][itemkey]["quantity"] <= 0) {
            equipment.find("#quantity").append(new Option("無庫存"));
        } else {
            for (
                let i = 1;
                i <= equipments[genrekey][itemkey]["quantity"];
                i++
            ) {
                equipment.find("#quantity").append(new Option(i));
            }
        }
    }

    //借用更多設備點選時
    $("#moreBtn").click(function () {
        //複製設備表格模板，更改id，接到.equipmentContainer的最後方
        let equipment = $("#equipmentTemplate")
            .clone(true, true)
            .prop("id", "equipment")
            .removeClass("d-none")
            .appendTo(".equipmentContainer");
        //更改設備編號
        equipment.find("#equipmentNum").text("No." + ++equipmentNum);
        //顯示刪除鈕
        equipment.find("#dltBtn").removeClass("d-none");
        //建立設備表格#genre, #item, #quantity的選項
        equipmentBuildUp(equipment);
    });

    //表單送出檢查
    $("form").submit(function () {
        //姓名檢查
        if ($.trim($("#name").val()) === "") {
            alert("姓名不可為空白");

            return false;
        }

        //依身分別檢查
        if ($("#identity option:selected").text() === "學生") {
            //系級檢檢查
            if ($.trim($("#grade").val()) === "") {
                alert("系級不可為空白");

                return false;
            }

            //手機格式檢查
            if (
                !$("#phone")
                    .val()
                    .match(/^09\d{8}$/)
            ) {
                alert("手機號碼格式不符");

                return false;
            }

            //證件選擇其他時，檢查替代的證件
            if (
                $("#certificate option:selected").text() === "其他" &&
                $.trim($("#certificateOther").val()) === ""
            ) {
                alert("抵押證件不可為空白");

                return false;
            }
        } else if ($("#identity option:selected").text() === "教職員") {
            //分機格式檢查
            if (
                !$("#phone")
                    .val()
                    .match(/^\d{5}$/)
            ) {
                alert("分機號碼格式不符");

                return false;
            }
        }

        //設備借用數量檢查
        if ($("#wantRentChk").prop("checked") === false && equipmentNum === 0) {
            alert("沒有借用的教室或設備");

            return false;
        }

        //鑰匙種類檢查
        if (
            $("#wantRentChk").prop("checked") === true &&
            $("#key_type option:selected").text() === "請選擇鑰匙種類"
        ) {
            alert("請選擇鑰匙種類");

            return false;
        }

        if (
            $("#wantRentChk").prop("checked") === true &&
            $("#key_type option:selected").text().includes("無庫存")
        ) {
            alert("請選擇其他鑰匙種類");

            return false;
        }

        //鑰匙用途檢查
        if (
            $("#wantRentChk").prop("checked") === true &&
            $("#key_usage option:selected").text() === "請選擇用途"
        ) {
            alert("請選擇鑰匙用途");

            return false;
        }

        //設備用途檢查
        let equipmentFlag = true;
        let equipmentItems = [];

        $(".equipmentContainer")
            .find("select[id='item']")
            .each(function () {
                if (
                    equipmentItems.find(
                        (element) =>
                            element === $(this).find("option:selected").text()
                    )
                ) {
                    alert("有重複借用的設備");

                    equipmentFlag = false;
                } else {
                    equipmentItems.push($(this).find("option:selected").text());
                }
            });

        let illegalQuantity = false;
        $(".equipmentContainer")
            .find("select[id='quantity']")
            .each(function () {
                if ($(this).find("option:selected").text() === "無庫存") {
                    illegalQuantity = true;
                    equipmentFlag = false;
                }
            });
        if (illegalQuantity) {
            alert("有無庫存的設備申請");
        }

        let illegalUsage = false;
        let illegalSubusageDept = false;
        let illegalSubusageOther = false;
        $(".equipmentContainer")
            .find("select[id='usage']")
            .each(function () {
                if ($(this).find("option:selected").text() === "請選擇用途") {
                    illegalUsage = true;
                    equipmentFlag = false;
                }

                if ($(this).find("option:selected").text() === "系學會") {
                    if (
                        $.trim(
                            $(this)
                                .parents(".form-row")
                                .find("#sub_usage")
                                .val()
                        ) === ""
                    ) {
                        illegalSubusageDept = true;
                        equipmentFlag = false;
                    }
                }

                if ($(this).find("option:selected").text() === "其他") {
                    if (
                        $.trim(
                            $(this)
                                .parents(".form-row")
                                .find("#sub_usage")
                                .val()
                        ) === ""
                    ) {
                        illegalSubusageOther = true;
                        equipmentFlag = false;
                    }
                }
            });
        if (illegalUsage) {
            alert("請選擇設備用途");
        }

        if (illegalSubusageDept) {
            alert("部名不可為空白");
        }

        if (illegalSubusageOther) {
            alert("用途不可為空白");
        }

        return equipmentFlag;
    });
});
