<!DOCTYPE html>
<html>
<head>
    <link href="\assets\css\colorbox.css" rel="stylesheet">
    <title>Page Title</title>
</head>
<body>
{{ csrf_field() }}
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pjfftizzvelgx3o59hbh1le630911saqeuzd6i99ycidt05m"></script>
<textarea name="content" class="form-control my-editor"></textarea>
<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        plugins: [
            "image",

        ],
        toolbar: "image",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
</body>
</html>
