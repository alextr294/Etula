@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</h1>
    <br>
    <h3>début : {{$lesson->begin_at}}  fin : {{$lesson->end_at}}</h3>
    <br>
    <h3>Alternants : </h3>
    <br>
    @foreach($students as $student)
    <h3>{{$student[0][0]->name}} : {{$student[1]}}</h3>
    @endforeach
</div>
@endsection
