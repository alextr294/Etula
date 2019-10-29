@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enseignants</h1>
    <h2>Séances</h2>
    @foreach($lessons as $lesson)
        <ul class="nav flex-column">
            <li class="nav-item">{{$lesson->name}}
                @if($lesson->token == null)
                    <form action="{{ route('token_create',$lesson->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit">( + )</button>
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
    <a class="btn btn-primary disabled">Partager un lien</a>
</div>
@endsection
