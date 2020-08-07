$("document").ready(function () {
    // 身分改變時
    $("#identity").change(() => {
        // 選擇身份顯示or隱藏學部、班年級
        $("#degreePart, #gradePart, #cardPart").toggleClass("d-none");

        // 分機或手機
        if ($("#identity option:selected").text() === "學生") {
            $('label[for="phone"]').children(".text").text("手機號碼");
            $("#degreePart, #gradePart, #cardPart").removeClass("d-none");
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
            $('label[for="phone"]').children(".text").text("分機");
            $("#degreePart, #gradePart, #cardPart").addClass("d-none");
            $("#certificateOther").parent().addClass("d-none");
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

    let rentEquipmentNum = 0;

    // 是否借用教室的核取方塊改變時
    $("#wantRentChk").change(function () {
        $("#classroomSection").toggleClass("d-none");
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

    $("#phone").on("input", () => {
        if ($("#identity option:selected").text() === "學生") {
            // 手機
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
            //分機
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

    $("#certificate").change(function () {
        if ($("#certificate option:selected").text() === "其他") {
            $("#certificate").parent().removeClass("col-12").addClass("col-5");
            $("#certificateOther")
                .removeClass("is-invalid")
                .attr("required", true);
            $("#certificateOther")
                .parent()
                .removeClass("d-none")
                .addClass("d-flex align-items-end");
        } else {
            $("#certificateOther")
                .prop("required", false)
                .parent()
                .removeClass("d-flex align-items-end")
                .addClass("d-none");
            $("#certificate").parent().removeClass("col-5").addClass("col-12");
        }
    });

    let genrekey, itemkey, item, quantity;

    function equipmentBuildUp(equipment /*jQuery Object*/) {
        Object.keys(equipments).forEach((element) =>
            equipment.find("#genre").append(new Option(element))
        );
        genrekey = equipment.find("#genre option:selected").val();
        equipment.find("#item").children().remove().end();
        Object.keys(equipments[genrekey]).forEach((element) =>
            equipment.find("#item").append(new Option(element))
        );

        itemkey = equipment.find("#item option:selected").val();
        equipment.find("#quantity").children().remove().end();
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            equipment.find("#quantity").append(new Option(i));
        }
    }

    $("#genre").change(function () {
        genrekey = $(this).find("option:selected").val();
        item = $(this).parents("#equipment").find("#item");
        item.children().remove().end();
        Object.keys(equipments[genrekey]).forEach((element) =>
            item.append(new Option(element))
        );

        itemkey = item.find("option:selected").val();
        quantity = $(this).parents("#equipment").find("#quantity");
        quantity.children().remove().end();
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            quantity.append(new Option(i));
        }
    });

    $("#item").change(function () {
        genrekey = $(this)
            .parents("#equipment")
            .find("#genre option:selected")
            .val();
        itemkey = $(this).find("option:selected").val();
        quantity = $(this).parents("#equipment").find("#quantity");
        quantity.children().remove().end();
        for (let i = 1; i <= equipments[genrekey][itemkey]["quantity"]; i++) {
            quantity.append(new Option(i));
        }
    });

    let equipmentNum = 0;
    $("#dltBtn").click(function () {
        $(".equipmentContainer").children().last().remove();
        $(".equipmentContainer")
            .children()
            .last()
            .find("#dltBtn")
            .removeClass("d-none");
        equipmentNum--;
        if (--rentEquipmentNum === 0) {
            $("button[type='submit']").addClass("disabled");
        }
    });

    $("#moreBtn").click(function () {
        $(".equipmentContainer")
            .children()
            .last()
            .find("#dltBtn")
            .addClass("d-none");

        let equipment = $("#equipmentTemplate")
            .clone(true, true)
            .prop("id", "equipment")
            .removeClass("d-none")
            .appendTo(".equipmentContainer");
        equipment.find("#equipmentNum").text("No." + ++equipmentNum);
        equipment.find("#dltBtn").removeClass("d-none");
        equipmentBuildUp(equipment);
        if (++rentEquipmentNum > 0) {
            $("button[type='submit']").removeClass("disabled");
        }
    });

    $("#identity option:contains(" + application["identity"] + ")")
        .prop("selected", true)
        .change();

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
        }
    }

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

    function fillInRentEquipment(rent_equipment) {
        $("#moreBtn").click();
        console.log(rent_equipment);
        $(".equipmentContainer")
            .children()
            .last()
            .find("#equipment_id")
            .val(rent_equipment["id"]);
        $(".equipmentContainer")
            .children()
            .last()
            .find("#genre option:contains(" + rent_equipment["genre"] + ")")
            .prop("selected", true)
            .change();
        $(".equipmentContainer")
            .children()
            .last()
            .find("#item option:contains(" + rent_equipment["item"] + ")")
            .prop("selected", true)
            .change();
        $(".equipmentContainer")
            .children()
            .last()
            .find(
                "#quantity option:contains(" + rent_equipment["quantity"] + ")"
            )
            .prop("selected", true);
        $(".equipmentContainer")
            .children()
            .last()
            .find("#usage")
            .val(rent_equipment["usage"]);
        $(".equipmentContainer")
            .children()
            .last()
            .find("#remark")
            .val(rent_equipment["remark"]);
    }

    console.log(typeof rent_equipments);
    if (rent_equipments != "") {
        Object.keys(rent_equipments).forEach((element) =>
            fillInRentEquipment(rent_equipments[element])
        );
    }
});
