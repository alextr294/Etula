@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <h2>{{ $exception->getMessage() }}</h2>
    </div>
</div>
@endsection
