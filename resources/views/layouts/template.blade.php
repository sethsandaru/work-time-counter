
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @foreach (\App\Libraries\AssetManager::$css as $css_file)
        <link rel="stylesheet" href="{{$css_file}}" />
    @endforeach
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

@foreach (\App\Libraries\AssetManager::$js as $js_file)
    <script src="{{$js_file}}"></script>
@endforeach

</body>
</html>
