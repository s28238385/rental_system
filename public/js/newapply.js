(function () {

    $(document).ready(function () {

        $('#agreeBtn').click(e => {
            $('#ruleSection').remove();
            $('#formSection').toggleClass('d-none');
        });

        // 身分改變時
        $('#identity').change(() => {
            // 選擇身份顯示or隱藏學部、班年級
            $('#degreePart, #gradePart, #cardPart').toggleClass('d-none');

            // 分機或手機
            if ($('#identity option:selected').text() == "學生") {
                $('label[for="phone"]').text('手機號碼');
                $('#degreePart, #gradePart, #cardPart').removeClass('d-none');
            } else {
                $('label[for="phone"]').text('分機');
                $('#degreePart, #gradePart, #cardPart').addClass('d-none');
            }
        });

        // 選擇學部改變班年級
        $('#degree').change(() => {

            let classOptions = ['A', 'B'];
            let gradeOptions = ['一', '二', '三', '四', '五', '六', '七'];

            switch ($("#degree option:selected").text()) {
                case '大學部':
                    stop = 4;
                    break;
                case '碩士班':
                case '碩士在職專班':
                    stop = 2;
                    break;
                case '博士班':
                    stop = 7;
                    break;
            }

            $('#grade').empty();

            if (stop == 4) {
                for (let i = 0; i < stop; i++) {
                    for (let c of classOptions) {
                        $('#grade').append(new Option(gradeOptions[i] + c));
                    }
                }
                return;
            }

            for (let i = 0; i < stop; i++) {
                $('#grade').append(new Option(gradeOptions[i]));
            }
        });
        // 先觸發第一次選擇
        $('#degree').change();

        // 是否借用教室的核取方塊改變時
        $('#wantRentChk').change(function () {
            $('#classroomSection').toggleClass('d-none');
        });

        $('#phone').on('input', () => {
            if ($('#identity option:selected').text() == "學生") {
                // 手機
                if ($('#phone').val().match(/^09\d{8}$/)) {
                    $('#phone').removeClass('is-invalid');
                } else {
                    console.log('invalid')
                    $('#phone').addClass('is-invalid');
                }
            } else {
                分機
                if ($('#phone').val().match(/^d{5}$/)) {
                    $('#phone').addClass('is-invalid');
                } else {
                    $('#phone').removeClass('is-invalid');
                }
            }
        });

        let equipmentNum = 1;
        $('#dltBtn').hide();

        $('#moreBtn').click(function () {
            $('#equipment').wrap("<div id='temp'>");
            let equipment = $('#temp').clone();
            $('#equipment').unwrap();

            equipment.find('#equipmentNum').text('No.' + ++equipmentNum);
            equipment.find('#dltBtn').attr('id', 'dltBtn' + equipmentNum).show();
            equipment.find('#equipment').attr('id', 'equipment' + equipmentNum);
            $('#dltBtn' + (equipmentNum - 1)).hide();
            $('.equipmentContainer').append(equipment.html());
            $('#dltBtn' + equipmentNum).click(function () {
                $('#equipment' + equipmentNum--).remove();
                $('#dltBtn' + equipmentNum).show();
            });
        });

    })
})();