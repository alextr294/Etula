{{-- This file use _course_manager.scss --}}
@extends('layouts.app')

@section('content')
    <div class="container course-manager-content">
        <h1>Course Manager</h1>

        <div class="tbl-header">
            <table class="course-tbl" cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                </thead>
            </table>
        </div>

        <div class="tbl-content">
            <table class="course-tbl" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                @foreach($allUsers as $usersByType)
                    @foreach($usersByType as $user)
                    <tr>
                        <th>
                            <a href="{{ url('/users/'.$user->id) }}">{{ $user->name }}</a>
                        </th>
                        <th>{{ $user->email }}</th>
                        <th>{{ $user->type }}</th>
                    </tr>
                    @endforeach
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