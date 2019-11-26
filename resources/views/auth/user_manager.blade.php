{{-- This file uses _course_manager.scss --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12">
                <div class="course-manager-content">
                    <h1>Liste des utilisateurs</h1>

                    <div class="tbl-header cm-header">
                        <table class="course-tbl cm-course" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>E-Mail</th>
                                <th>Statut</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content cm-content">
                        <table class="course-tbl table table-striped" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                            @foreach($allUsers as $usersByType)
                                @foreach($usersByType as $user)
                                <tr>
                                    <th>
                                        @if ($user->type == "student")
                                            <a href="{{ route('student_present_lesson',array('idStudent'=>$user->id))}}">{{ $user->name }}</a>
                                        @else
                                            <a href="{{ url('/users/'.$user->id) }}">{{ $user->name }}</a>
                                        @endif
                                    </th>
                                    <th>{{ $user->email }}</th>
                                    @if ($user->type == "admin")
                                        <th>Administrateur</th>
                                    @elseif ($user->type == "teacher")
                                        <th>Enseignant</th>
                                    @elseif ($user->type == "student")
                                        <th>&Eacute;tudiant</th>
                                    @else
                                        <th>Inconnu</th>
                                    @endif
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(window).on("load resize ", function() {
            let scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({'padding-right':scrollWidth});
        }).resize();
    </script>
@endsection