<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Étula') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-color">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Étula') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}" class="nav-link">Login</a></li>
                    @else
                        @php
                            $user_type = Auth::user()->type
                        @endphp
                        @if($user_type == "admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsers" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Gestion des utilisateurs
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownUsers">
                                    <a class="dropdown-item" href="{{ route('users.create') }}">Créer un utilisateur</a>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Liste des utilisateurs</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTeaching" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Gestion des unités d'enseignement
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownTeaching">
                                    <a class="dropdown-item" href="{{ route('courses.create') }}">Ajouter une unité d'enseignement</a>
                                    <a class="dropdown-item" href="{{ route('courses.index') }}">Liste des unités d'enseignement</a>
                                </div>
                            </li>
                        @elseif($user_type == "teacher")
                            <li class="nav-item"><a class="nav-link" href="{{ route('lessons.create') }}">Créer une leçon</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('lessons.index') }}">Liste des leçons</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">En construction...</a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>
