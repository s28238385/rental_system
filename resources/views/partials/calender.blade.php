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
                <input id="date-select" class="mr-sm-2 form-control-sm" name="date-select" type="date" max="9999-12-31">
                <button class="btn btn-outline-primary my-2" type="button" id="toCertainWeek">前往</button>
            </div>
        </caption>
        <tr class="calender-data">
            <th id="time"></th>
            <th id="Sun" class="text-center table-cell-8"></th>
            <th id="Mon" class="text-center table-cell-8"></th>
            <th id="Tue" class="text-center table-cell-8"></th>
            <th id="Wed" class="text-center table-cell-8"></th>
            <th id="Thu" class="text-center table-cell-8"></th>
            <th id="Fri" class="text-center table-cell-8"></th>
            <th id="Sat" class="text-center table-cell-8"></th>
        </tr>
        <tr>
            <th id="1" class="text-center">08:00<br>~<br>09:00</th>
            <td id="Sun-1" class="p-0"></td>
            <td id="Mon-1" class="p-0"></td>
            <td id="Tue-1" class="p-0"></td>
            <td id="Wed-1" class="p-0"></td>
            <td id="Thu-1" class="p-0"></td>
            <td id="Fri-1" class="p-0"></td>
            <td id="Sat-1" class="p-0"></td>
        </tr>
        <tr>
            <th id="2" class="text-center">09:00<br>~<br>10:00</th>
            <td id="Sun-2" class="p-0"></td>
            <td id="Mon-2" class="p-0"></td>
            <td id="Tue-2" class="p-0"></td>
            <td id="Wed-2" class="p-0"></td>
            <td id="Thu-2" class="p-0"></td>
            <td id="Fri-2" class="p-0"></td>
            <td id="Sat-2" class="p-0"></td>
        </tr>
        <tr>
            <th id="3" class="text-center">10:00<br>~<br>11:00</th>
            <td id="Sun-3" class="p-0"></td>
            <td id="Mon-3" class="p-0"></td>
            <td id="Tue-3" class="p-0"></td>
            <td id="Wed-3" class="p-0"></td>
            <td id="Thu-3" class="p-0"></td>
            <td id="Fri-3" class="p-0"></td>
            <td id="Sat-3" class="p-0"></td>
        </tr>
        <tr>
            <th id="4" class="text-center">11:00<br>~<br>12:00</th>
            <td id="Sun-4" class="p-0"></td>
            <td id="Mon-4" class="p-0"></td>
            <td id="Tue-4" class="p-0"></td>
            <td id="Wed-4" class="p-0"></td>
            <td id="Thu-4" class="p-0"></td>
            <td id="Fri-4" class="p-0"></td>
            <td id="Sat-4" class="p-0"></td>
        </tr>
        <tr>
            <th id="Z" class="text-center">12:00<br>~<br>13:00</th>
            <td id="Sun-Z" class="p-0"></td>
            <td id="Mon-Z" class="p-0"></td>
            <td id="Tue-Z" class="p-0"></td>
            <td id="Wed-Z" class="p-0"></td>
            <td id="Thu-Z" class="p-0"></td>
            <td id="Fri-Z" class="p-0"></td>
            <td id="Sat-Z" class="p-0"></td>
        </tr>
        <tr>
            <th id="5" class="text-center">13:00<br>~<br>14:00</th>
            <td id="Sun-5" class="p-0"></td>
            <td id="Mon-5" class="p-0"></td>
            <td id="Tue-5" class="p-0"></td>
            <td id="Wed-5" class="p-0"></td>
            <td id="Thu-5" class="p-0"></td>
            <td id="Fri-5" class="p-0"></td>
            <td id="Sat-5" class="p-0"></td>
        </tr>
        <tr>
            <th id="6" class="text-center">14:00<br>~<br>15:00</th>
            <td id="Sun-6" class="p-0"></td>
            <td id="Mon-6" class="p-0"></td>
            <td id="Tue-6" class="p-0"></td>
            <td id="Wed-6" class="p-0"></td>
            <td id="Thu-6" class="p-0"></td>
            <td id="Fri-6" class="p-0"></td>
            <td id="Sat-6" class="p-0"></td>
        </tr>
        <tr>
            <th id="7" class="text-center">15:00<br>~<br>16:00</th>
            <td id="Sun-7" class="p-0"></td>
            <td id="Mon-7" class="p-0"></td>
            <td id="Tue-7" class="p-0"></td>
            <td id="Wed-7" class="p-0"></td>
            <td id="Thu-7" class="p-0"></td>
            <td id="Fri-7" class="p-0"></td>
            <td id="Sat-7" class="p-0"></td>
        </tr>
        <tr>
            <th id="8" class="text-center">16:00<br>~<br>17:00</th>
            <td id="Sun-8" class="p-0"></td>
            <td id="Mon-8" class="p-0"></td>
            <td id="Tue-8" class="p-0"></td>
            <td id="Wed-8" class="p-0"></td>
            <td id="Thu-8" class="p-0"></td>
            <td id="Fri-8" class="p-0"></td>
            <td id="Sat-8" class="p-0"></td>
        </tr>
        <tr>
            <th id="9" class="text-center">17:00<br>~<br>18:00</th>
            <td id="Sun-9" class="p-0"></td>
            <td id="Mon-9" class="p-0"></td>
            <td id="Tue-9" class="p-0"></td>
            <td id="Wed-9" class="p-0"></td>
            <td id="Thu-9" class="p-0"></td>
            <td id="Fri-9" class="p-0"></td>
            <td id="Sat-9" class="p-0"></td>
        </tr>
        <tr>
            <th id="A" class="text-center">18:00<br>~<br>19:00</th>
            <td id="Sun-A" class="p-0"></td>
            <td id="Mon-A" class="p-0"></td>
            <td id="Tue-A" class="p-0"></td>
            <td id="Wed-A" class="p-0"></td>
            <td id="Thu-A" class="p-0"></td>
            <td id="Fri-A" class="p-0"></td>
            <td id="Sat-A" class="p-0"></td>
        </tr>
        <tr>
            <th id="B" class="text-center">19:00<br>~<br>20:00</th>
            <td id="Sun-B" class="p-0"></td>
            <td id="Mon-B" class="p-0"></td>
            <td id="Tue-B" class="p-0"></td>
            <td id="Wed-B" class="p-0"></td>
            <td id="Thu-B" class="p-0"></td>
            <td id="Fri-B" class="p-0"></td>
            <td id="Sat-B" class="p-0"></td>
        </tr>
        <tr>
            <th id="C" class="text-center">20:00<br>~<br>21:00</th>
            <td id="Sun-C" class="p-0"></td>
            <td id="Mon-C" class="p-0"></td>
            <td id="Tue-C" class="p-0"></td>
            <td id="Wed-C" class="p-0"></td>
            <td id="Thu-C" class="p-0"></td>
            <td id="Fri-C" class="p-0"></td>
            <td id="Sat-C" class="p-0"></td>
        </tr>
        <tr>
            <th id="D" class="text-center">21:00<br>~<br>22:00</th>
            <td id="Sun-D" class="p-0"></td>
            <td id="Mon-D" class="p-0"></td>
            <td id="Tue-D" class="p-0"></td>
            <td id="Wed-D" class="p-0"></td>
            <td id="Thu-D" class="p-0"></td>
            <td id="Fri-D" class="p-0"></td>
            <td id="Sat-D" class="p-0"></td>
        </tr>
    </table>
</div>

<script src="{{ URL::asset('js/calender.js') }}" type="text/javascript"></script>