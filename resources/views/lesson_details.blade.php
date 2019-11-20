@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</h1>
    <br>
    <h3>début : {{$lesson->begin_at}}  fin : {{$lesson->end_at}}</h3>
    <br>
    <h3>Alternants : </h3>
    <br>
    <form action="{{ route('students_validate')}}" method="POST">
        {{ csrf_field() }}
        @foreach($students as $student)
        <h4>{{$student[0][0]->name}}
            @if($student[1])
            <input type="checkbox" id="student<?php echo $student[0][0]->id?>" name="student<?php echo $student[0][0]->id?>" checked>
            @else
            <input type="checkbox" id="student<?php echo $student[0][0]->id?>" name="student<?php echo $student[0][0]->id?>">
            @endif
        </h4>
        @endforeach
        <input id="lesson_id" name="lesson_id" type="hidden" value="{{$lesson->id}}">
        <br>
        <button id="validate-students" type="submit">Valider</button>
    </form>
</div>
@endsection
