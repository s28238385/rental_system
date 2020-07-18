function fillInDates(sun){
    let weekTraverse = new Date(sun);

    $('#Sun').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（日）");
    weekTraverse.addDay(1);
    $('#Mon').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（一）");
    weekTraverse.addDay(1);
    $('#Tue').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（二）");
    weekTraverse.addDay(1);
    $('#Wed').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（三）");
    weekTraverse.addDay(1);
    $('#Thu').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（四）");
    weekTraverse.addDay(1);
    $('#Fri').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（五）");
    weekTraverse.addDay(1);
    $('#Sat').html(weekTraverse.getFullYear() + "<br>" + (weekTraverse.getMonth() + 1) + "/" + weekTraverse.getDate() + "<br>（六）");
}

Date.prototype.addDay = function(days) {
    this.setDate(this.getDate() + days);

    return this;
}

Date.prototype.getSunday = function() {
    let day = this.getDay();

    switch(day){
        case 0:
            break;
        case 1:
            this.addDay(-1);
            break;

        case 2:
            this.addDay(-2);
            break;

        case 3:
            this.addDay(-3);
            break;

        case 4:
            this.addDay(-4);
            break;

        case 5:
            this.addDay(-5);
            break;

        case 6:
            this.addDay(-6);
            break;
    }
}

Date.prototype.toPreviousWeek = function(){
    this.addDay(-7);

    fillInDates(this);
}

Date.prototype.toThisWeek = function(){
    this.setTime(Date.now());
    this.getSunday();
    
    fillInDates(this);
}

Date.prototype.toNextWeek = function(){
    this.addDay(7);
    
    fillInDates(this);
}

$('document').ready(function(){
    let sundayOfShowingWeek = new Date();
    sundayOfShowingWeek.toThisWeek();

    $('#toPreviousWeek').click(function(){
        sundayOfShowingWeek.toPreviousWeek();
    });

    $('#toThisWeek').click(function(){
        sundayOfShowingWeek.toThisWeek();
    });

    $('#toNextWeek').click(function(){
        sundayOfShowingWeek.toNextWeek();
    });

    $('#toCertainWeek').click(function(){
        sundayOfShowingWeek = new Date($('#date-select').val());
        sundayOfShowingWeek.getSunday();

        fillInDates(sundayOfShowingWeek);
    })
});