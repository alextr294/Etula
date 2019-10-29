@extends('layouts.app')

@section('content')
<div class="wrapper">
    {{-- NavBar --}}
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Menu</h3>
        </div>
        <ul class="list-unstyled components">
            <li><a href=" {{ route('users.create') }}">Add new User</a></li>
            <li><a href=" {{ route('users.index') }}">View all Users</a></li>
            <li><a href=" {{ route('courses.create') }}">Add new Course</a></li>
            <li><a href=" {{ route('courses.index') }}">View all Courses</a></li>
        </ul>
    </nav>

    {{-- Page Content --}}
    <div id="content" class="container mt-5">
        {{-- NavBar Togle Button --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
            </div>
        </nav>
        <h1> Hello {{ Auth::user()->name }} </h1>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
@endsection