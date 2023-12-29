<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Browser Image</title>
    <script src="{!! asset('public/backend/app-assets/js/ckeditor/jquery.js') !!}"></script>
    <script src="{!! asset('public/backend/app-assets/js/ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var funcNum = <?php echo $_GET['CKEditorFuncNum'].';'; ?>
            $('#fileExplorer').on('click', 'img', function() {
                var fileUrl = $(this).attr('title');
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();
            });
        });
    </script>
    <style>
        ul.file_list{
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul.file_list li{
            float: left;
            margin: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        ul.file_list img {
            display: block;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        ul.file_list li:hover{
            background: aliceblue;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div id="fileExplorer">
        @foreach ($fileNames as $file)
            <div class="thumbnail">
                <ul class="file_list">
                    <li>
                        <img src="{{ asset('/public/uploads/ckeditor/'.$file) }}" alt="thumb" title="{{ asset('/public/uploads/ckeditor/'.$file) }}" width="120" height="120">
                        <span>{{ $file }}</span>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
</body>
</html>
