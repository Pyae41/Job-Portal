<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mail['head'] }}</title>
</head>
<body>
    {{ $mail['title'] }}
    {{ $mail['body'] }}
    @php
        if(isset($mail['link'])){
            echo $mail['link'];
        }
    @endphp

</body>
</html>
