
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('js/underscore.js')}}"></script>
    <script src="{{asset('js/jquery.noty.js')}}"></script>
    <script src="{{asset('js/toaster.js')}}"></script>
    <script src="{{asset('js/ajax_service.js')}}"></script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>Time Counter Note</h1>
    <p>Counting your work time & note it if you want!</p>
</div>


<div class="container" style="margin-top:30px">
    @yield('content')
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright &copy; 2019 by Seth Phat - Phat Tran Minh. All Right Reserved!</p>
</div>

<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="display: none;">
        </div>
    </div>
</div>


</body>
</html>
