@extends('layouts.app')

@section('content')
<div class="container course-manager-content">
    <h1>Course Manager</h1>

    <div class="tbl-header">
        <table class="course-tbl" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Group</th>
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
@endsection

@section('js')
    <script type="text/javascript">
        $(window).on("load resize ", function() {
            let scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({'padding-right':scrollWidth});
        }).resize();
    </script>
@endsection