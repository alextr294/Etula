@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">

                <h1>Liste des cours @isset($userStudent)<u>{{$userStudent->name}}</u>@endisset</h1>
                <br>

                <div class="tbl-header teacher-header">
                    <table class="seance-tbl" cellpadding="0" cellspacing="0" border="0">
                        <thead>
                            <tr>
                                <th>Dates</th>
                                <th>Nom de l'UE</th>
                                <th>Présent</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content teacher-content">
                    <table class="seance-tbl table table-striped" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        @foreach ($AllLessons as $lesson)
                            <tr>
                                <th>début : {{$lesson->begin_at}}  <br> fin : {{$lesson->end_at}}</th>
                                <th>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</th>
                                @if(in_array($lesson->id, $PresentLessonsId))
                                    <th bgcolor="green"></th>
                                @else
                                    <th bgcolor="red"></th>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                @if(Auth::user()->type == 'admin')
                    <a class="btn btn-primary" href="{{route('student_present_lesson_pdf',array('idStudent'=>$userStudent->id))}}">Générer un PDF</a>
                @else
                    <a class="btn btn-primary" href="{{route('StudentPdf')}}">Générer un PDF</a>
                @endif
            </div>
        </div>
    </div>
@endsection
