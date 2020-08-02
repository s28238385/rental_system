$("document").ready(function () {
    // 身分改變時
    $("#identity").change(() => {
        // 選擇身份顯示or隱藏學部、班年級
        $("#degreePart, #gradePart, #cardPart").toggleClass("d-none");

        // 分機或手機
        if ($("#identity option:selected").text() === "學生") {
            $('label[for="phone"]').children('.text').text("手機號碼");
            $("#degreePart, #gradePart, #cardPart").removeClass("d-none");
            if($("#phone").val() != "" && !$("#phone").val().match(/^09\d{8}$/)){
                $("#phone").addClass('is-invalid');
            }
            else {
                $("#phone").removeClass('is-invalid');
            }
        } else {
            $('label[for="phone"]').children('.text').text("分機");
            $("#degreePart, #gradePart, #cardPart").addClass("d-none");
            $("#certificateOther").parent().addClass('d-none');
            if($("#phone").val() != "" && !$("#phone").val().match(/^\d{5}$/)){
                $("#phone").addClass('is-invalid');
            }
            else {
                $("#phone").removeClass('is-invalid');
            }
        }
    });

    let rentEquipmentNum = 0;

    // 是否借用教室的核取方塊改變時
    $("#wantRentChk").change(function () {
        $("#classroomSection").toggleClass("d-none");
        if($("#wantRentChk").is(":checked")){
            rentEquipmentNum++;
            if(rentEquipmentNum > 0){
                $("button[type='submit']").removeClass('disabled');
            }
        }
        else{
            rentEquipmentNum--;
            if(rentEquipmentNum === 0){
                $("button[type='submit']").addClass('disabled');
            }
        }
    });

    $("#phone").on("input", () => {
        if ($("#identity option:selected").text() === "學生") {
            // 手機
            if ($("#phone").val().match(/^09\d{8}$/)) {
                $("#phone").removeClass("is-invalid");
            } else {
                $("#phone").addClass("is-invalid");
            }
        } else {
            //分機
            if ($("#phone").val().match(/^\d{5}$/)) {
                $("#phone").removeClass("is-invalid");
            } else {
                $("#phone").addClass("is-invalid");
            }
        }
    });

    $("#certificate").change(function () {
        if ($("#certificate option:selected").text() === "其他") {
            $("#certificate").parent().removeClass('col-12').addClass('col-5');
            $("#certificateOther").removeClass("is-invalid").attr('required', true);
            $("#certificateOther").parent().removeClass('d-none').addClass('d-flex align-items-end');
        } else {
            $("#certificateOther").prop('required', false).parent().removeClass('d-flex align-items-end').addClass("d-none");
            $("#certificate").parent().removeClass('col-5').addClass('col-12');
        }
    });

    let equipments = <?php echo json_encode($equipments); ?>;
    let namekey, indexkey, index, quantity;

    function equipmentBuildUp(equipment/*jQuery Object*/) {
        Object.keys(equipments).forEach((element) => equipment.find('#equipment_name').append(new Option(element)));
        namekey = equipment.find("#equipment_name option:selected").val();
        equipment.find("#index").children().remove().end();
        Object.keys(equipments[namekey]).forEach((element) =>
            equipment.find("#index").append(new Option(element))
        );

        indexkey = equipment.find("#index option:selected").val();
        equipment.find("#quantity").children().remove().end();
        for (let i = 1; i <= equipments[namekey][indexkey]["quantity"]; i++) {
            equipment.find("#quantity").append(new Option(i));
        }
    }

    $("#equipment_name").change(function () {
        namekey = $(this).find("option:selected").val();
        index = $(this).parents("#equipment").find("#index");
        index.children().remove().end();
        Object.keys(equipments[namekey]).forEach((element) =>
            index.append(new Option(element))
        );

        indexkey = index.find("option:selected").val();
        quantity = $(this).parents("#equipment").find("#quantity");
        quantity.children().remove().end();
        for (let i = 1; i <= equipments[namekey][indexkey]["quantity"]; i++) {
            quantity.append(new Option(i));
        }
    });

    $("#index").change(function () {
        namekey = $(this)
            .parents("#equipment")
            .find("#equipment_name option:selected")
            .val();
        indexkey = $(this).find("option:selected").val();
        quantity = $(this).parents("#equipment").find("#quantity");
        quantity.children().remove().end();
        for (let i = 1; i <= equipments[namekey][indexkey]["quantity"]; i++) {
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
        if(--rentEquipmentNum === 0){
            $("button[type='submit']").addClass('disabled');
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
            .prop('id', 'equipment')
            .removeClass("d-none")
            .appendTo(".equipmentContainer");
        equipment.find("#equipmentNum").text("No." + ++equipmentNum);
        equipment.find("#dltBtn").removeClass("d-none");
        equipmentBuildUp(equipment);
        if(++rentEquipmentNum > 0){
            $("button[type='submit']").removeClass('disabled');
        }
    });

    //處理傳入資料
    let application = <?php echo json_encode($application); ?>;
    let rent_equipments = <?php echo json_encode($rent_equipments); ?>;
    console.log(rent_equipments)

    $("#identity option:contains(" + application['identity'] + ")").prop('selected', true).change();

    if(application['certificate'] != null){
        if(application['certificate'] === '學生證' | application['certificate'] === '身分證' | application['certificate'] === '健保卡' |application['certificate'] === '駕照'){
            $("#certificate option:contains(" + application['certificate'] + ")").prop('selected', true).change();
        }
        else {
            $("#certificate option:contains(其他)").prop('selected', true).change();
        }
    }

    if(application['classroom'] != null){
        $("#wantRentChk").prop('checked', true).change();
        $("#classroom option:contains(" + application['classroom'] + ")").prop('selected', true);
        $("#key_type option:contains(" + application['key_type'] + ")").prop('selected', true);
    }

    function fillInRentEquipment(rent_equipment){
        $("#moreBtn").click();
        $(".equipmentContainer").children().last().find("#equipment_name option:contains(" + rent_equipment['name'] + ")").prop('selected', true).change();
        $(".equipmentContainer").children().last().find("#index option:contains(" + rent_equipment['index'] + ")").prop('selected', true).change();
        $(".equipmentContainer").children().last().find("#quantity option:contains(" + rent_equipment['quantity'] + ")").prop('selected', true);
        $(".equipmentContainer").children().last().find("#usage").val(rent_equipment['usage']);
        $(".equipmentContainer").children().last().find("#remark").val(rent_equipment['remark']);
    }

    if(rent_equipments != ""){
        Object.keys(rent_equipments).forEach( (element) => fillInRentEquipment(rent_equipments[element]));
    }
});
