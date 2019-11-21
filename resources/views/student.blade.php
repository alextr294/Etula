@extends('layouts.app')

@section('content')
<div class="col-md-3">
    <form action="{{ route('token_validate')}}" method="POST">
        {{ csrf_field() }}
        <h3>Valider ma présence</h3>
        <div class="">
        	<input id="token" type="text" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" value="{{ $token }}">
        	@if ($errors->has('token'))
        	<span class="help-block">
            	<strong>{{ $errors->first('token') }}</strong>
        	</span>
        	@endif
        </div>
        <button type="submit">Valider</button>
    </form>
    <br>
    <br>
    <a class="btn btn-primary" href="{{route('lesson_student')}}">Récapitulatif de présences</a>
</div>
@endsection
