<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Api</h1>
    @foreach ($categories as $category)
        <h1>{{ $category['eng_title'] }}</h1>
    @endforeach

    <form action="/demo" method="post">
        @csrf
        <input type="text" name="name" id="name">
        <button type="submit">submit</button>
    </form>
</body>

</html>
