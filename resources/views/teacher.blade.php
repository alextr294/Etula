@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Séances</h1>
    <br>
    @foreach($lessons as $lesson)
        <ul class="nav flex-column">
            <li class="nav-item"><a title="lien" href="{{route('lessons.show', $lesson->id)}}">
                {{$lesson->name}}</a>
                @if($lesson->token == null)
                <a href="{{ route('code', [$lesson->id]) }}">(+)</a>
                @else
                <span> : {{ $lesson->token->token }}</span>
                <span> : {{ route('student_code_validation', $lesson->token->token) }}</span>
                @endif
            </li>
        </ul>
    @endforeach
    <br>
    <a class="btn btn-primary" href="{{route('lessons.create')}}">Créer une nouvelle séance</a>
</div>
@endsection
