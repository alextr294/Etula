@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="title-ue">
                    <h1>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</h1>
                </div>
                <br>
                <div class="time-ue">
                    <h3>Début : <span style="color: green;">{{$lesson->begin_at}}</span></h3>
                    <h3>Fin : <span style="color: red;">{{$lesson->end_at}}</span></h3>
                </div>
                <br>
                <h3>Responsable : {{$lesson->owner->user->name}}</h3>
                <br>
                <div class="alternants-table">
                    <h4>Alternants</h4>
                    <form action="{{ route('students_validate')}}" method="POST">
                        {{ csrf_field() }}

                        <div class="tbl-header teacher-header">
                            <table class="seance-tbl" cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                <tr>
                                    <th>Alternant</th>
                                    <th>Pr&eacute;sence</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tbl-content teacher-content">
                            <table class="seance-tbl table table-striped" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <th>{{$student[0][0]->name}}</th>
                                            <th>
                                                @if($student[1])
                                                    <input type="checkbox" id="student<?php echo $student[0][0]->id?>" name="student<?php echo $student[0][0]->id?>" checked>
                                                @else
                                                    <input type="checkbox" id="student<?php echo $student[0][0]->id?>" name="student<?php echo $student[0][0]->id?>">
                                                @endif
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <input id="lesson_id" name="lesson_id" type="hidden" value="{{$lesson->id}}">
                        <br>
                        <button id="validate-students" class="btn btn-primary float-right" type="submit">Valider</button>
                    </form>
                </div>

                <br>
                <br>

                @if(Auth::user()->id == $lesson->teacher_id)
                    <div class="enseignants-table">
                        <h4>Enseignants</h4>

                        <form action="{{ route('teacher_add')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="tbl-header teacher-header">
                                <table class="seance-tbl" cellpadding="0" cellspacing="0" border="0">
                                    <thead>
                                    <tr>
                                        <th>Enseignant</th>
                                        <th>Ajout</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="tbl-content teacher-content">
                                <table class="seance-tbl table table-striped" cellpadding="0" cellspacing="0" border="0">
                                    <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <th>{{$teacher->name}}</th>
                                            <th>
                                                @if( $teacher->id != $lesson->teacher_id )
                                                    <input type="checkbox" id="{{$teacher->id}}" name="list{{$teacher->id}}" value="{{$teacher->id}}">
                                                @endif
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                            <br>
                            <button id="add-teacher" class="btn btn-primary float-right" type="submit">Ajouter des enseignants</button>
                        </form>
                    </div>
                @endif
                <br>
                <br>
            </div>
        </div>
    </div>
@endsection
