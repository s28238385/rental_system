$(document).ready(function(){
    $('nav').addClass('d-none');

    $('#borrow').click(function(){
        $('#borrow').toggleClass('border-bottom-white-1px pb-1');
        $('#borrow').siblings('#subindex').toggleClass('d-none');
    });

    $('#appointment').click(function(){
        $('#appointment').toggleClass('border-bottom-white-1px pb-1');
        $('#appointment').siblings('#subindex').toggleClass('d-none');
    });

    $('#equipment').click(function(){
        $('#equipment').toggleClass('border-bottom-white-1px pb-1');
        $('#equipment').siblings('#subindex').toggleClass('d-none');
    });
});