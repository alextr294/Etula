@extends('layouts.app')

@section('content')
<div class="col-md-3">
    <form action="{{ route('token_validate')}}" method="POST">
        {{ csrf_field() }}
        <h3>Valider ma présence</h3>
        <input id="token" type="text" class="form-control" name="token" value="{{ $token }}">

        <button type="submit">Valider</button>
    </form>
    <br>
    <br>
    <a class="btn btn-primary" href="{{route('lesson_student')}}">Récapitulatif de présences</a>
</div>
@endsection
