(function () {
    $(document).ready(function () {

        $('#agreeBtn').click(function (e) {
            // to do
        });

        // 身分改變時
        $('#identity').change(function () {
            // 選擇身份顯示or隱藏學部、班年級
            $('.degree, .grade').toggleClass('d-none');

            // 分機或手機
            if ($('#identity option:selected').text() == "學生") {
                $('label[for="phone"]').text('手機號碼');
            } else {
                $('label[for="phone"]').text('分機');
            }
        });
        $('#identity').val(0).change();

        // 選擇學部改變班年級
        $('#degree').change(function () {

            var options_class = ['A', 'B'];
            var options_grade = ['一', '二', '三', '四', '五', '六', '七'];

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
                for (var i = 0; i < stop; i++) {
                    for (var j = 0; j < options_class.length; j++) {
                        $('#grade').append(new Option(options_grade[i] + options_class[j]));
                    }
                }
                return;
            }

            for (var i = 0; i < stop; i++) {
                $('#grade').append(new Option(options_grade[i]));
            }
        });
        // 先觸發第一次選擇
        $('#degree').val(0).change();

        // 是否借用教室的核取方塊改變時
        $('#wantRentChk').change(function () {
            $('#classroomSection').toggleClass('d-none');
        });

        $('#phone').change(function () {

        });

        var equipmentNum = 1;
        $('#dltBtn').hide();

        $('#moreBtn').click(function () {
            $('#equipment').wrap("<div id='temp'>");
            var equipment = $('#temp').clone();
            $('#equipment').unwrap();

            equipment.find('#equipmentNum').text(++equipmentNum);
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