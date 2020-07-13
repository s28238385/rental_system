Date.prototype.addDay = function(days){
    let date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);

    return date;
}

Date.prototype.minusDay = function(days){
    let date = new Date(this.valueOf());
    date.setDate(date.getDate() - days);

    return date;
}

Date.prototype.getWeek = function(){
    let sundayOfShowingWeek = new Date();
    
    let day = this.getDay();

    switch(day){
        case 0:
            sundayOfShowingWeek = this;
            break;

        case 1:
            sundayOfShowingWeek = this.minusDay(1);
            break;

        case 2:
            sundayOfShowingWeek = this.minusDay(2);
            break;

        case 3:
            sundayOfShowingWeek = this.minusDay(3);
            break;

        case 4:
            sundayOfShowingWeek = this.minusDay(4);
            break;

        case 5:
            sundayOfShowingWeek = this.minusDay(5);
            break;

        case 6:
            sundayOfShowingWeek = this.minusDay(6);
            break;
    }
    
    return sundayOfShowingWeek;
}

function fillInDates(){
    document.getElementById('Sun').innerHTML = sundayOfShowingWeek.getFullYear() + "<br>" + ( sundayOfShowingWeek.getMonth() + 1 ) + "/" + sundayOfShowingWeek.getDate() + "<br>（日）";
    document.getElementById('Mon').innerHTML = sundayOfShowingWeek.addDay(1).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(1).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(1).getDate() + "<br>（一）";
    document.getElementById('Tue').innerHTML = sundayOfShowingWeek.addDay(2).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(2).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(2).getDate() + "<br>（二）";
    document.getElementById('Wed').innerHTML = sundayOfShowingWeek.addDay(3).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(3).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(3).getDate() + "<br>（三）";
    document.getElementById('Thu').innerHTML = sundayOfShowingWeek.addDay(4).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(4).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(4).getDate() + "<br>（四）";
    document.getElementById('Fri').innerHTML = sundayOfShowingWeek.addDay(5).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(5).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(5).getDate() + "<br>（五）";
    document.getElementById('Sat').innerHTML = sundayOfShowingWeek.addDay(6).getFullYear() + "<br>" + ( sundayOfShowingWeek.addDay(6).getMonth() + 1 ) + "/" + sundayOfShowingWeek.addDay(6).getDate() + "<br>（六）";
}

function toPreviousWeek(){
    sundayOfShowingWeek = sundayOfShowingWeek.minusDay(7);

    fillInDates();
}

function toThisWeek(){
    sundayOfShowingWeek = date.getWeek();

    fillInDates();
}

function toNextWeek(){
    sundayOfShowingWeek = sundayOfShowingWeek.addDay(7);
    
    fillInDates();
}

function toCertainWeek(){
    let insert = new Date(document.getElementById('search-block').value);

    sundayOfShowingWeek = insert.getWeek();
    
    fillInDates();
}

let date = new Date();
toThisWeek();