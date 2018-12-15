<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Filemanager</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('vendor/laravel-filemanager/img/folder.png') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">


    <div class="row">

        <div class="col-md-6">
            <h2>Standalone Image Button</h2>
            <div class="input-group">
          <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
              <i class="fa fa-picture-o"></i> Choose
            </a>
          </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
            </div>

            <img id="holder2" style="margin-top:15px;max-height:100px;">
        </div>
    </div>

</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
    var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
</script>





<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
</script>
<script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm2').filemanager('file', {prefix: route_prefix});
</script>

<form action="http://localhost/web/lights/post">

    <p>
        <input name="name">
        <input  name="coordinate">
        <input  name="created_at">
        <input  name="updated_at">
        <input  name="images">

        <input type="hidden" name="_method" value="POST">Отправить<Br>

      </p>
    <p><input type="submit"></p>
</form>

</body>
</html>
