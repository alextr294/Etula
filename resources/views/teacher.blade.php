<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enseignants</title>
</head>
<body>
    <h1>Enseignants</h1>

    <h2>Ressources actives</h2>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Code #1</a>
        </li>
    </ul>

    <br>
    <br>

    <h2>Options</h2>
    <input type=button onclick=window.location.href="{{ url('/lesson') }}"; value="Créer une nouvelle séance" />
    <br>
    <button type="button">Partager un lien</button>
</body>
</html>
