@extends('layouts.app')

@section('content')
<div class="wrapper">
    {{-- Page Content --}}
    <div id="content" class="container mt-5">
        <h1> Bonjour {{ Auth::user()->name }} !</h1>
    </div>
</div>
@endsection