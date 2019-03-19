@extends('layouts.template')

@section('content')
    <style>
        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        .counter-text {
            font-size: 150px;
        }

        @media(max-width: 1024px) {
            .counter-text {
                font-size: 120px;
            }
        }
    </style>

    <div class="row">
        <div class="col-lg-8">
            <h2>New Counting Note</h2>
        </div>
        <div class="col-lg-4 text-right">
            <button class="btn btn-primary" id="saveBtn" disabled>Save</button>
        </div>
    </div>

    <div class="text-center">
        <h1 class="counter-text">
            <span id="minute">00</span><span id="blink">:</span><span id="second">00</span>
        </h1>

        <div class="mt-4">
            <button id="startCounter" class="btn btn-success">Start</button>
            <button id="pauseCounter" class="btn btn-warning" disabled>Pause</button>
            <button id="stopCounter" class="btn btn-danger" disabled>Stop</button>
        </div>
    </div>

    <form id="frmNote" onsubmit="return false;">
        <div class="mb-4 mt-4">
            <h3>Note Information</h3>

            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="10"></textarea>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(init);
        $.fn.disabled = function () {
            $(this).prop('disabled', true);
            return this;
        };
        $.fn.enabled = function () {
            $(this).prop('disabled', false);
            return this;
        };

        var timer = 0;
        var intervalObj = null;

        function init() {
            $("#startCounter").click(start);
            $("#pauseCounter").click(pause);
            $("#stopCounter").click(stop);
            $("#saveBtn").click(save);
        }

        function start() {
            intervalObj = setInterval(secondsToTime, 1000);
            $("#pauseCounter, #stopCounter").enabled();
            $("#startCounter").disabled();
            $("#blink").addClass('blink_me');
        }

        function pause() {
            clearInterval(intervalObj);
            $("#startCounter").enabled();
            $("#pauseCounter").disabled();
            $("#blink").removeClass('blink_me');
        }

        function stop() {
            clearInterval(intervalObj);
            $("#pauseCounter, #startCounter, #stopCounter").disabled();
            $("#saveBtn").enabled();
            $("#blink").removeClass('blink_me');
        }

        function save() {
            if (timer == 0) {
                SethPhatToaster.error('You must start the counter first.');
                $("#startCounter").prop('disabled', false);
                return;
            }

            SethPhatToaster.confirm(null, doSave);
        }

        function doSave() {
            var postData = $("#frmNote").serializeObject();
            postData.time = timer;

            // request ajax now
            AjaxService.post("{{route('addPage')}}", postData)
                .done(function (data) {
                    if (data.code !== 200) {
                        SethPhatToaster.error();
                        return;
                    }

                    SethPhatToaster.success(null, function () {
                        window.location.href = "{{route('homePage')}}";
                    });
                });
        }

        function secondsToTime()
        {
            timer++;

            var divisor_for_minutes = timer % (60 * 60);
            var minutes = Math.floor(divisor_for_minutes / 60);

            var divisor_for_seconds = divisor_for_minutes % 60;
            var seconds = Math.ceil(divisor_for_seconds);

            $("#minute").text(minutes < 10 ? "0" + minutes : minutes);
            $("#second").text(seconds < 10 ? "0" + seconds : seconds);
        }
    </script>
@endsection