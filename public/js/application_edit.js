$("document").ready(function () {
    let rentEquipmentNum = 0; //總借用設備數（包含鑰匙）
    let equipmentNum = 0; //借用設備的編號
    let genrekey, itemkey;

    //身分改變時
    $("#identity").change(() => {
        //選擇身份顯示or隱藏學部、班年級
        $("#gradePart, #cardPart").toggleClass("d-none");

        //分機或手機、隱藏系級/抵押證件與否
        if ($("#identity option:selected").text() === "學生") {
            $("#grade").prop("required", false);
            $('label[for="phone"]').children(".text").text("手機號碼");
            $("#degreePart, #gradePart, #cardPart").removeClass("d-none");
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
        } else {
            $("#grade").prop("required", false);
            $('label[for="phone"]').children(".text").text("分機");
            $("#gradePart, #cardPart").addClass("d-none");
            $("#certificateOther").parent().addClass("d-none");
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

    //是否借用教室的核取方塊改變時
    $("#wantRentChk").change(function () {
        $("#classroomSection").toggleClass("d-none");
        //檢查有無借用設備以決定是否將送出鈕無效化
        if ($("#wantRentChk").is(":checked")) {
            rentEquipmentNum++;
            if (rentEquipmentNum > 0) {
                $("button[type='submit']").removeClass("disabled");
            }
        } else {
            rentEquipmentNum--;
            if (rentEquipmentNum === 0) {
                $("button[type='submit']").addClass("disabled");
            }
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

    //抵押證件選項改變時決定是否顯示額外的輸入欄
    $("#certificate").change(function () {
        if ($("#certificate option:selected").text() === "其他") {
            //更改版面配置與填入required
            $("#certificate")
                .parent()
                .removeClass("col-md-12")
                .addClass("col-md-5");
            $("#certificateOther")
                .removeClass("is-invalid")
                .attr("required", true);
            $("#certificateOther")
                .parent()
                .removeClass("d-none")
                .addClass("d-flex align-items-end");
        } else {
            //取消required與更改版面配置
            $("#certificateOther")
                .prop("required", false)
                .parent()
                .removeClass("d-flex align-items-end")
                .addClass("d-none");
            $("#certificate")
                .parent()
                .removeClass("col-md-5")
                .addClass("col-md-12");
        }
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
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            $(this)
                .parents("#equipment")
                .find("#quantity")
                .append(new Option(i));
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
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            $(this)
                .parents("#equipment")
                .find("#quantity")
                .append(new Option(i));
        }
    });

    //點選刪除時
    $("#dltBtn").click(function () {
        //移除最後一個設備表格
        $(".equipmentContainer").children().last().remove();
        //顯示更新後最後一個的刪除鍵
        $(".equipmentContainer")
            .children()
            .last()
            .find("#dltBtn")
            .removeClass("d-none");
        //減少設備借用數
        equipmentNum--;
        //如果總設備借用數為0則使送出鈕無效化
        if (--rentEquipmentNum === 0) {
            $("button[type='submit']").addClass("disabled");
        }
    });

    //借用更多設備時，設備資訊的建構
    function equipmentBuildUp(equipment /*jQuery Object*/) {
        //改變#genre內的選項
        //清空#genre選項
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
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            equipment.find("#quantity").append(new Option(i));
        }
    }

    //借用更多設備點選時
    $("#moreBtn").click(function () {
        //隱藏最後一個設備表格的刪除鍵
        $(".equipmentContainer")
            .children()
            .last()
            .find("#dltBtn")
            .addClass("d-none");

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

        rentEquipmentNum++;

        //取消送出按鈕無效化
        $("button[type='submit']").removeClass("disabled");
    });

    //將欲編輯申請的資料填入
    //身分填入
    $("#identity option:contains(" + application["identity"] + ")")
        .prop("selected", true)
        .change();

    //抵押證件填入
    if (application["certificate"] != null) {
        if (
            (application["certificate"] === "學生證") |
            (application["certificate"] === "身分證") |
            (application["certificate"] === "健保卡") |
            (application["certificate"] === "駕照")
        ) {
            $(
                "#certificate option:contains(" +
                    application["certificate"] +
                    ")"
            )
                .prop("selected", true)
                .change();
        } else {
            $("#certificate option:contains(其他)")
                .prop("selected", true)
                .change();
            $("#certificateOther").val(application["certificate"]);
        }
    }

    //借用教室選項勾選、選擇教室及鑰匙種類填入
    if (application["classroom"] != null) {
        $("#wantRentChk").prop("checked", true).change();
        $("#classroom option:contains(" + application["classroom"] + ")").prop(
            "selected",
            true
        );
        $("#key_type option:contains(" + application["key_type"] + ")").prop(
            "selected",
            true
        );
    }

    //將設備資料填入設備表格
    function fillInRentEquipment(rent_equipment) {
        //新增設備表格
        $("#moreBtn").click();

        //改變#genre選項
        $(".equipmentContainer")
            .children()
            .last()
            .find("#genre option:contains(" + rent_equipment["genre"] + ")")
            .prop("selected", true)
            .change();
        //改變#item選項
        $(".equipmentContainer")
            .children()
            .last()
            .find("#item option:contains(" + rent_equipment["item"] + ")")
            .prop("selected", true)
            .change();
        //改變#quantity選項
        $(".equipmentContainer")
            .children()
            .last()
            .find(
                "#quantity option:contains(" + rent_equipment["quantity"] + ")"
            )
            .prop("selected", true);
        //填入用途
        $(".equipmentContainer")
            .children()
            .last()
            .find("#usage")
            .val(rent_equipment["usage"]);
        //填入備註
        $(".equipmentContainer")
            .children()
            .last()
            .find("#remark")
            .val(rent_equipment["remark"]);
        //填入狀態
        $(".equipmentContainer")
            .children()
            .last()
            .find("#status option:contains(" + rent_equipment["status"] + ")")
            .prop("selected", true);
    }

    //若有借用設備則建立設備表格
    if (rent_equipments != "") {
        Object.keys(rent_equipments).forEach((element) =>
            fillInRentEquipment(rent_equipments[element])
        );
    }
});
