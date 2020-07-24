<div id="calender">
    <table class="table table-bordered">
        <caption id="week-switch">
            <div class="d-flex justify-content-between my-1">
                <button type="button" class="btn btn-outline-primary week-switch-button" id="toPreviousWeek">上一周</button>
                <button type="button" class="btn btn-outline-primary week-switch-button" id="toThisWeek">回本周</button>
                <button type="button" class="btn btn-outline-primary week-switch-button" id="toNextWeek">下一周</button>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <label for="date-select" class="mr-1 my-2 text-black">前往指定日期：</label>
                <input id="date-select" class="mr-sm-2" name="date-select" type="date">
                <button class="btn btn-outline-primary my-2" type="button" id="toCertainWeek">前往</button>
            </div>
        </caption>
        <tr class="calender-data">
            <th id="time"></th>
            <th id="Sun" class="text-center"></th>
            <th id="Mon" class="text-center"></th>
            <th id="Tue" class="text-center"></th>
            <th id="Wed" class="text-center"></th>
            <th id="Thu" class="text-center"></th>
            <th id="Fri" class="text-center"></th>
            <th id="Sat" class="text-center"></th>
        </tr>
        <tr>
            <th headers="time" id="1" class="text-center">08:00<br>~<br>09:00</th>
            <td headers="Sun" id="Sun-1"></td>
            <td headers="Mon" id="Mon-1"></td>
            <td headers="Tue" id="Tue-1"></td>
            <td headers="Wed" id="Wed-1"></td>
            <td headers="Thu" id="Thu-1"></td>
            <td headers="Fri" id="Fri-1"></td>
            <td headers="Sat" id="Sat-1"></td>
        </tr>
        <tr>
            <th headers="time" id="2" class="text-center">09:00<br>~<br>10:00</th>
            <td headers="Sun" id="Sun-2"></td>
            <td headers="Mon" id="Mon-2"></td>
            <td headers="Tue" id="Tue-2"></td>
            <td headers="Wed" id="Wed-2"></td>
            <td headers="Thu" id="Thu-2"></td>
            <td headers="Fri" id="Fri-2"></td>
            <td headers="Sat" id="Sat-2"></td>
        </tr>
        <tr>
            <th headers="time" id="3" class="text-center">10:00<br>~<br>11:00</th>
            <td headers="Sun" id="Sun-3"></td>
            <td headers="Mon" id="Mon-3"></td>
            <td headers="Tue" id="Tue-3"></td>
            <td headers="Wed" id="Wed-3"></td>
            <td headers="Thu" id="Thu-3"></td>
            <td headers="Fri" id="Fri-3"></td>
            <td headers="Sat" id="Sat-3"></td>
        </tr>
        <tr>
            <th headers="time" id="4" class="text-center">11:00<br>~<br>12:00</th>
            <td headers="Sun" id="Sun-4"></td>
            <td headers="Mon" id="Mon-4"></td>
            <td headers="Tue" id="Tue-4"></td>
            <td headers="Wed" id="Wed-4"></td>
            <td headers="Thu" id="Thu-4"></td>
            <td headers="Fri" id="Fri-4"></td>
            <td headers="Sat" id="Sat-4"></td>
        </tr>
        <tr>
            <th headers="time" id="Z" class="text-center">12:00<br>~<br>13:00</th>
            <td headers="Sun" id="Sun-Z"></td>
            <td headers="Mon" id="Mon-Z"></td>
            <td headers="Tue" id="Tue-Z"></td>
            <td headers="Wed" id="Wed-Z"></td>
            <td headers="Thu" id="Thu-Z"></td>
            <td headers="Fri" id="Fri-Z"></td>
            <td headers="Sat" id="Sat-Z"></td>
        </tr>
        <tr>
            <th headers="time" id="5" class="text-center">13:00<br>~<br>14:00</th>
            <td headers="Sun" id="Sun-5"></td>
            <td headers="Mon" id="Mon-5"></td>
            <td headers="Tue" id="Tue-5"></td>
            <td headers="Wed" id="Wed-5"></td>
            <td headers="Thu" id="Thu-5"></td>
            <td headers="Fri" id="Fri-5"></td>
            <td headers="Sat" id="Sat-5"></td>
        </tr>
        <tr>
            <th headers="time" id="6" class="text-center">14:00<br>~<br>15:00</th>
            <td headers="Sun" id="Sun-6"></td>
            <td headers="Mon" id="Mon-6"></td>
            <td headers="Tue" id="Tue-6"></td>
            <td headers="Wed" id="Wed-6"></td>
            <td headers="Thu" id="Thu-6"></td>
            <td headers="Fri" id="Fri-6"></td>
            <td headers="Sat" id="Sat-6"></td>
        </tr>
        <tr>
            <th headers="time" id="7" class="text-center">15:00<br>~<br>16:00</th>
            <td headers="Sun" id="Sun-7"></td>
            <td headers="Mon" id="Mon-7"></td>
            <td headers="Tue" id="Tue-7"></td>
            <td headers="Wed" id="Wed-7"></td>
            <td headers="Thu" id="Thu-7"></td>
            <td headers="Fri" id="Fri-7"></td>
            <td headers="Sat" id="Sat-7"></td>
        </tr>
        <tr>
            <th headers="time" id="8" class="text-center">16:00<br>~<br>17:00</th>
            <td headers="Sun" id="Sun-8"></td>
            <td headers="Mon" id="Mon-8"></td>
            <td headers="Tue" id="Tue-8"></td>
            <td headers="Wed" id="Wed-8"></td>
            <td headers="Thu" id="Thu-8"></td>
            <td headers="Fri" id="Fri-8"></td>
            <td headers="Sat" id="Sat-8"></td>
        </tr>
        <tr>
            <th headers="time" id="9" class="text-center">17:00<br>~<br>18:00</th>
            <td headers="Sun" id="Sun-9"></td>
            <td headers="Mon" id="Mon-9"></td>
            <td headers="Tue" id="Tue-9"></td>
            <td headers="Wed" id="Wed-9"></td>
            <td headers="Thu" id="Thu-9"></td>
            <td headers="Fri" id="Fri-9"></td>
            <td headers="Sat" id="Sat-9"></td>
        </tr>
        <tr>
            <th headers="time" id="A" class="text-center">18:00<br>~<br>19:00</th>
            <td headers="Sun" id="Sun-A"></td>
            <td headers="Mon" id="Mon-A"></td>
            <td headers="Tue" id="Tue-A"></td>
            <td headers="Wed" id="Wed-A"></td>
            <td headers="Thu" id="Thu-A"></td>
            <td headers="Fri" id="Fri-A"></td>
            <td headers="Sat" id="Sat-A"></td>
        </tr>
        <tr>
            <th headers="time" id="B" class="text-center">19:00<br>~<br>20:00</th>
            <td headers="Sun" id="Sun-B"></td>
            <td headers="Mon" id="Mon-B"></td>
            <td headers="Tue" id="Tue-B"></td>
            <td headers="Wed" id="Wed-B"></td>
            <td headers="Thu" id="Thu-B"></td>
            <td headers="Fri" id="Fri-B"></td>
            <td headers="Sat" id="Sat-B"></td>
        </tr>
        <tr>
            <th headers="time" id="C" class="text-center">20:00<br>~<br>21:00</th>
            <td headers="Sun" id="Sun-C"></td>
            <td headers="Mon" id="Mon-C"></td>
            <td headers="Tue" id="Tue-C"></td>
            <td headers="Wed" id="Wed-C"></td>
            <td headers="Thu" id="Thu-C"></td>
            <td headers="Fri" id="Fri-C"></td>
            <td headers="Sat" id="Sat-C"></td>
        </tr>
        <tr>
            <th headers="time" id="D" class="text-center">21:00<br>~<br>22:00</th>
            <td headers="Sun" id="Sun-D"></td>
            <td headers="Mon" id="Mon-D"></td>
            <td headers="Tue" id="Tue-D"></td>
            <td headers="Wed" id="Wed-D"></td>
            <td headers="Thu" id="Thu-D"></td>
            <td headers="Fri" id="Fri-D"></td>
            <td headers="Sat" id="Sat-D"></td>
        </tr>
    </table>
</div>

<script src="{{ URL::asset('js/calender.js') }}" type="text/javascript"></script>