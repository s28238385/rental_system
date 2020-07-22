$(document).ready(function(){
    $('nav').addClass('d-none');

    $('#borrow').click(function(){
        $('#borrow').toggleClass('border-bottom-white-1px pb-1');
        $('#borrow').siblings('#subindex').toggleClass('d-none');
    });
});