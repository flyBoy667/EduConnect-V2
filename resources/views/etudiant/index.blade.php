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
    <h1>Bienvenue sur la page de l'étudiant</h1>
    @if (\Illuminate\Support\Facades\Auth::check())
        <p>Vous êtes connecté en tant que {{ \Illuminate\Support\Facades\Auth::user()->nom }}.</p>
        <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Déconnexion</button>
        </form>
    @else
        <p>Vous n'êtes pas connecté.</p>
    @endif
</div>
</body>
</html>
