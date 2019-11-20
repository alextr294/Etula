@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12">
                <div class="course-manager-content">
                    <h1>Gestionnaire d'unit&eacute;s d'enseignement</h1>

                    <div class="tbl-header">
                        <table class="course-tbl" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Groupe</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="tbl-content">
                        <table class="course-tbl" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                @foreach($courses as $course)
                                <tr>
                                    <th>
                                        <a href="{{ url('/courses/'.$course['id']) }}">{{ $course['name'] }}</a>
                                    </th>
                                    <th>{{ $course['group_name'] }}</th>
                                </tr>
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