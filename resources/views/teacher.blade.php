@extends('layouts.app')

@section('content')
<div class="container">
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <br>
        <title>Enseignants</title>
    </head>
    <body>
        <h1>Enseignants</h1>

        <h2>Séances</h2>
        @foreach($lessons as $lesson)
        @php
        $lessonToken = App\LessonToken::where('lesson_id', $lesson->id)->first();
        @endphp
        <ul class="nav flex-column">
            <li class="nav-item">{{$lesson->name}}
                @if($lessonToken==null)
                <form action="{{ route('token_create',$lesson->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit">( + )</button>
                </form>
                @else
                <span>  : {{$lessonToken->token}}</span>
                @endif
            </li>
        </ul>
        @endforeach

        <br>
        <br>

        <h2>Options</h2>
        <input type=button onclick=window.location.href="{{ url('/lesson_create') }}"; value="Créer une nouvelle séance" />
        <br>
        <button type="button" disabled="disabled">Partager un lien</button>
    </body>
    </html>
</div>
@endsection
