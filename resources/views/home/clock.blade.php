
@extends('master')


@section('title')
    Clock
@stop

@section('content')
    <div class="text-center">
        <p class="lead">{{trans('clock.seconds')}}</p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="60" id="seconds"></div>
        </div>

        <p class="lead">{{trans('clock.minutes')}}</p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="60" id="minutes"></div>
        </div>

        <p class="lead">{{trans('clock.hours')}}</p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="24" id="hours"></div>
        </div>
    </div>
@stop

@section('extraJS')
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                var date = new Date();
                var milli = date.getMilliseconds();
                /**
                 * To get the total milliseconds that have passed in the current minute
                 * We just need to do: seconds in the current minute * 1000 + milliseconds in the current second
                 * to get the width for the progress bar: answer of the previous calculation / max milliseconds in a minute * 100
                 */
                var seconds = date.getSeconds();
                var milliSeconds = (seconds * 1000) + milli;
                var secondsWidth = (milliSeconds / 59999) * 100;
                /*
                 console.log('====================== SECONDS DATA ============================');
                 console.log('var seconds: ' + seconds);
                 console.log('var milliSeconds: ' + milliSeconds);
                 console.log('var secondsWidth: ' + secondsWidth);
                 */
                /**
                 * This one is more difficult to calculate
                 * To get the milliseconds that have passed in the current hour we need to do the following:
                 * minutes in the current hour * max milliseconds in a minute + milliseconds in the current minute
                 * To get the width: answer of the previous calculation / max milliseconds in an hour * 100
                 */
                var minutes = date.getMinutes();
                var milliMinutes = (minutes * 59999) + milliSeconds;
                var minutesWidth = (milliMinutes / 3539941) * 100;
                /*
                 console.log('====================== MINUTES DATA ============================');
                 console.log('var minutes: ' + minutes);
                 console.log('var milliMinutes: ' + milliMinutes);
                 console.log('var minutesWidth: ' + minutesWidth);
                 */
                /**
                 * This one will produce large numbers
                 * To get the milliseconds that have passed in the current day we need to do the following calculation:
                 * hours in the current day * max milliseconds in an hour + milliseconds in the current hour
                 * To get the width: answer of the previous calculation / max milliseconds in a day * 100
                 */
                var hours = date.getHours();
                var milliHours = (hours * 3539941) + milliMinutes;
                var hoursWidth = (milliHours / 84958584) * 100;
                /*
                 console.log('====================== HOURS DATA ============================');
                 console.log('var hours: ' + hours);
                 console.log('var milliHours: ' + milliHours);
                 console.log('var hoursWidth: ' + hoursWidth);
                 */
                // Then set the answers of the calculation to the appropriate progress bars
                $("#seconds").css('width', secondsWidth + "%").html(seconds);
                $("#minutes").css('width', minutesWidth + "%").html(minutes);
                $("#hours").css('width', hoursWidth + "%").html(hours);
            },1); // Repeat this process every millisecond
        });
    </script>
@stop

@section('extraCSS')
    <style type="text/css">
        .progress-bar {
            transition: none;
            -o-transition: none;
            -webkit-transition: none;
            color: #8CD5FF;
            background-color: #385665;
        }
    </style>
@stop