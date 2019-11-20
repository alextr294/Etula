@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</h1>
    <br>
    <h3>début : {{$lesson->begin_at}}  fin : {{$lesson->end_at}}</h3>
    <br>
    <h3>Responsable: {{$lesson->teacher_id}}</h3>
    <h3>User {{Auth::user()->id}}</h3>
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
    
    @if(Auth::user()->id == $lesson->teacher_id)
        <form action="{{ route('teacher_add')}}" method="POST">
            {{ csrf_field() }}
        @foreach($teachers as $teacher)
            @if( $teacher->id != $lesson->teacher_id )
            <h4>{{$teacher->name}}  <input type="checkbox" id="{{$teacher->id}}" name="list{{$teacher->id}}" value="{{$teacher->id}}"></h4>
            @endif
        @endforeach
        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
        <button id="add-teacher" type="submit">Add Teacher(s)</button>
        </form>
    @endif
</div>
@endsection
