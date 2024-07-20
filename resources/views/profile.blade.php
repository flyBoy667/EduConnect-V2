<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Profile</title>
</head>
<body>
<div class="container">
    <h1>Profile</h1>
    <p>Vous êtes connecté en tant que {{\Illuminate\Support\Facades\Auth::user()->telephone}}.</p>
</div>
</body>
</html>
