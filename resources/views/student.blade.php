@extends('layouts.app')

@section('content')
<div class="col-md-3">
    <form action="{{ route('token_validate')}}" method="POST">
        {{ csrf_field() }}
        <h3>Valider ma présence</h3>
        <input id="token" type="text" class="form-control" name="token" value="{{ $token }}">

        <button type="submit">Valider</button>
    </form>
    @foreach ($lessons as $lesson)
        <p>{{ $lesson->name }}</p>
    @endforeach
</div>
@endsection
