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
    <h1>Bienvenue sur la page du professeur</h1>
    @if (Auth::check())
        <p>Vous êtes connecté en tant que {{ Auth::user()->nom }}.</p>
        <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Déconnexion</button>
        </form>

        <h2>Vos Modules</h2>
        <ul>
            @foreach ($modules as $module)
                <li>{{ $module->nom_module }}</li>
            @endforeach
        </ul>
    @else
        <p>Vous n'êtes pas connecté.</p>
    @endif
</div>
</body>
</html>
