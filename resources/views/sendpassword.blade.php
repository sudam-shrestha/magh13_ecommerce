<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>
        Dear {{ $data['shop']->name }},
    </h1>

    <p>
        {!! $data['content'] !!}
    </p>

    <a href="">
        Login
    </a>
</body>

</html>
