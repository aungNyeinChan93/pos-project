<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category Create</title>
</head>

<body>
    <h1> Category Create Success </h1>
    <h3>Category{{ $category->id }}</h3>
    <p>You have been create {{ $category->name }} at {{ $category->created_at->format('d-m-y') }}</p>
    <a href="{{ route("category#list") }}">Check it </a>
</body>

</html>
