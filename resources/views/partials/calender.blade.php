@section('content')
<div id="calender">
    <table>
        <caption id="week-switch">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-primary" onclick="toPreviousWeek()">上一周</button>
                <button type="button" class="btn btn-outline-primary" onclick="toThisWeek()">回本周</button>
                <button type="button" class="btn btn-outline-primary" onclick="toNextWeek()">下一周</button>
            </div>
        </caption>
        <tr>
            <th id="time"></th>
            <th id="Sun"></th>
            <th id="Mon"></th>
            <th id="Tue"></th>
            <th id="Wed"></th>
            <th id="Thu"></th>
            <th id="Fri"></th>
            <th id="Sat"></th>
        </tr>
        <tr>
            <th headers="time" id="8-9">08:00<br>~<br>09:00</th>
            <td headers="Sun" id="Sun-8"></td>
            <td headers="Mon" id="Mon-8"></td>
            <td headers="Tue" id="Tue-8"></td>
            <td headers="Wed" id="Wed-8"></td>
            <td headers="Thu" id="Thu-8"></td>
            <td headers="Fri" id="Fri-8"></td>
            <td headers="Sat" id="Sat-8"></td>
        </tr>
        <tr>
            <th headers="time" id="9-10">09:00<br>~<br>10:00</th>
            <td headers="Sun" id="Sun-9"></td>
            <td headers="Mon" id="Mon-9"></td>
            <td headers="Tue" id="Tue-9"></td>
            <td headers="Wed" id="Wed-9"></td>
            <td headers="Thu" id="Thu-9"></td>
            <td headers="Fri" id="Fri-9"></td>
            <td headers="Sat" id="Sat-9"></td>
        </tr>
        <tr>
            <th headers="time" id="10-11">10:00<br>~<br>11:00</th>
            <td headers="Sun" id="Sun-10"></td>
            <td headers="Mon" id="Mon-10"></td>
            <td headers="Tue" id="Tue-10"></td>
            <td headers="Wed" id="Wed-10"></td>
            <td headers="Thu" id="Thu-10"></td>
            <td headers="Fri" id="Fri-10"></td>
            <td headers="Sat" id="Sat-10"></td>
        </tr>
        <tr>
            <th headers="time" id="11-12">11:00<br>~<br>12:00</th>
            <td headers="Sun" id="Sun-11"></td>
            <td headers="Mon" id="Mon-11"></td>
            <td headers="Tue" id="Tue-11"></td>
            <td headers="Wed" id="Wed-11"></td>
            <td headers="Thu" id="Thu-11"></td>
            <td headers="Fri" id="Fri-11"></td>
            <td headers="Sat" id="Sat-11"></td>
        </tr>
        <tr>
            <th headers="time" id="12-13">12:00<br>~<br>13:00</th>
            <td headers="Sun" id="Sun-12"></td>
            <td headers="Mon" id="Mon-12"></td>
            <td headers="Tue" id="Tue-12"></td>
            <td headers="Wed" id="Wed-12"></td>
            <td headers="Thu" id="Thu-12"></td>
            <td headers="Fri" id="Fri-12"></td>
            <td headers="Sat" id="Sat-12"></td>
        </tr>
        <tr>
            <th headers="time" id="13-14">13:00<br>~<br>14:00</th>
            <td headers="Sun" id="Sun-13"></td>
            <td headers="Mon" id="Mon-13"></td>
            <td headers="Tue" id="Tue-13"></td>
            <td headers="Wed" id="Wed-13"></td>
            <td headers="Thu" id="Thu-13"></td>
            <td headers="Fri" id="Fri-13"></td>
            <td headers="Sat" id="Sat-13"></td>
        </tr>
        <tr>
            <th headers="time" id="14-15">14:00<br>~<br>15:00</th>
            <td headers="Sun" id="Sun-14"></td>
            <td headers="Mon" id="Mon-14"></td>
            <td headers="Tue" id="Tue-14"></td>
            <td headers="Wed" id="Wed-14"></td>
            <td headers="Thu" id="Thu-14"></td>
            <td headers="Fri" id="Fri-14"></td>
            <td headers="Sat" id="Sat-14"></td>
        </tr>
        <tr>
            <th headers="time" id="15-16">15:00<br>~<br>16:00</th>
            <td headers="Sun" id="Sun-15"></td>
            <td headers="Mon" id="Mon-15"></td>
            <td headers="Tue" id="Tue-15"></td>
            <td headers="Wed" id="Wed-15"></td>
            <td headers="Thu" id="Thu-15"></td>
            <td headers="Fri" id="Fri-15"></td>
            <td headers="Sat" id="Sat-15"></td>
        </tr>
        <tr>
            <th headers="time" id="16-17">16:00<br>~<br>17:00</th>
            <td headers="Sun" id="Sun-16"></td>
            <td headers="Mon" id="Mon-16"></td>
            <td headers="Tue" id="Tue-16"></td>
            <td headers="Wed" id="Wed-16"></td>
            <td headers="Thu" id="Thu-16"></td>
            <td headers="Fri" id="Fri-16"></td>
            <td headers="Sat" id="Sat-16"></td>
        </tr>
        <tr>
            <th headers="time" id="17-18">17:00<br>~<br>18:00</th>
            <td headers="Sun" id="Sun-17"></td>
            <td headers="Mon" id="Mon-17"></td>
            <td headers="Tue" id="Tue-17"></td>
            <td headers="Wed" id="Wed-17"></td>
            <td headers="Thu" id="Thu-17"></td>
            <td headers="Fri" id="Fri-17"></td>
            <td headers="Sat" id="Sat-17"></td>
        </tr>
        <tr>
            <th headers="time" id="18-19">18:00<br>~<br>19:00</th>
            <td headers="Sun" id="Sun-18"></td>
            <td headers="Mon" id="Mon-18"></td>
            <td headers="Tue" id="Tue-18"></td>
            <td headers="Wed" id="Wed-18"></td>
            <td headers="Thu" id="Thu-18"></td>
            <td headers="Fri" id="Fri-18"></td>
            <td headers="Sat" id="Sat-18"></td>
        </tr>
        <tr>
            <th headers="time" id="19-20">19:00<br>~<br>20:00</th>
            <td headers="Sun" id="Sun-19"></td>
            <td headers="Mon" id="Mon-19"></td>
            <td headers="Tue" id="Tue-19"></td>
            <td headers="Wed" id="Wed-19"></td>
            <td headers="Thu" id="Thu-19"></td>
            <td headers="Fri" id="Fri-19"></td>
            <td headers="Sat" id="Sat-19"></td>
        </tr>
        <tr>
            <th headers="time" id="20-21">20:00<br>~<br>21:00</th>
            <td headers="Sun" id="Sun-20"></td>
            <td headers="Mon" id="Mon-20"></td>
            <td headers="Tue" id="Tue-20"></td>
            <td headers="Wed" id="Wed-20"></td>
            <td headers="Thu" id="Thu-20"></td>
            <td headers="Fri" id="Fri-20"></td>
            <td headers="Sat" id="Sat-20"></td>
        </tr>
        <tr>
            <th headers="time" id="21-22">21:00<br>~<br>22:00</th>
            <td headers="Sun" id="Sun-21"></td>
            <td headers="Mon" id="Mon-21"></td>
            <td headers="Tue" id="Tue-21"></td>
            <td headers="Wed" id="Wed-21"></td>
            <td headers="Thu" id="Thu-21"></td>
            <td headers="Fri" id="Fri-21"></td>
            <td headers="Sat" id="Sat-21"></td>
        </tr>
    </table>
</div>
@endsection('content')

@section('script')
<script src="{{ URL::to('js/calender.js') }}" type="text/javascript"></script>
@endsection('script')