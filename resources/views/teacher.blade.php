@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enseignants</h1>
    <h2>Séances</h2>
    @foreach($lessons as $lesson)
        <ul class="nav flex-column">
            <li class="nav-item"><a title="lien" href="{{route('lessons.show', $lesson->id)}}">
                {{$lesson->name}}</a>
                @if($lesson->token == null)
                <form action="{{ route('token_create',$lesson->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button id="create-token" type="submit" data-id="{{ $lesson->id }}">( + )</button>
                </form>
                @else
                <span> : {{ $lesson->token->token }}</span>
                <span> : {{ route('student_code_validation', $lesson->token->token) }}</span>
                @endif
            </li>
        </ul>
    @endforeach
    <h2>Options</h2>
    <a class="btn btn-primary" href="{{route('lessons.create')}}">Créer une nouvelle séance</a>
</div>
@endsection
