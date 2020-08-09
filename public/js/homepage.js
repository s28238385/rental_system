$("document").ready(function () {
    //隱藏上方工具列及設定版面為100%視窗高度
    $("nav").addClass("d-none");
    $("body").addClass("homepage vh-100");

    //點選教室設備借用時，顯示或隱藏子選項
    $("#borrow").click(function () {
        $("#borrow").toggleClass("border-bottom-white-1px pb-1");
        $("#borrow").siblings("#subindex").toggleClass("d-none");
    });

    //點選教室預約時，顯示或隱藏子選項
    $("#appointment").click(function () {
        $("#appointment").toggleClass("border-bottom-white-1px pb-1");
        $("#appointment").siblings("#subindex").toggleClass("d-none");
    });

    //點選設備管理時，顯示或隱藏子選項
    $("#equipment").click(function () {
        $("#equipment").toggleClass("border-bottom-white-1px pb-1");
        $("#equipment").siblings("#subindex").toggleClass("d-none");
    });

    //點選使用者時，顯示或隱藏子選項
    $("#user").click(function () {
        $("#user").siblings("#subindex").toggleClass("d-none");
    });
});
