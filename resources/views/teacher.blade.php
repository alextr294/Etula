@extends('layouts.app')

@section('content')
<div class="container">
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <br>
        <title>Enseignants</title>
    </head>
    <body>
        <h1>Enseignants</h1>

        <h2>Séances</h2>

        @foreach($lessons as $lesson)
        @php
        $lessonToken = App\LessonToken::where('lesson_id', $lesson->id)->first();
        @endphp
        <ul class="nav flex-column">
            <li class="nav-item">{{$lesson->name}}
                @if($lessonToken==null)
                    <form>
                        {{ csrf_field() }}
                        <button id="create-token" type="submit" data-id="{{ $lesson->id }}">( + )</button>
                    </form>
                @else
                    <span> : {{ $lessonToken->token }}</span>
                    <span> : {{ route('student_code_validation', $lessonToken->token) }}</span>
                @endif
            </li>
        </ul>
        @endforeach

        <br>
        <br>

        <h2>Options</h2>
        <input type=button onclick=window.location.href="{{ url('/lesson_create') }}"; value="Créer une nouvelle séance" />
        <br>
        <button type="button" disabled="disabled">Partager un lien</button>
    </body>
    </html>
</div>
@endsection

@section('js')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>

<script type="text/javascript">
    var long,lat;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        lat = position.coords.latitude;
        long = position.coords.longitude;
    }

    jQuery(document).ready(function(){
        getLocation();

        jQuery('#create-token').click(function(e){

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ url('token_create') }}",
                method: 'post',
                data: {
                    id: this.getAttribute('data-id'),
                    longitude: long,
                    latitude: lat
                },
                success: function(result){
                    if (result.success == true) {
                        location.reload();
                    }
                }});
        });
    });
</script>
@endsection
