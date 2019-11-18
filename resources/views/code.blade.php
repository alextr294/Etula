@extends('layouts.app')
<meta http-equiv="refresh" content="10; url={{action('TokenController@delete',$token->lesson_id)}}">
@section('content')
<div class="container">
    <br>
    <br>
    <h1 id="decompte">Il reste 10 seconde(s)</h1>
    <br>
    <br>
    <br>
    <br>
    <h1>Code : {{$token->token}}</h1>
</div>


<script>
    var sec = 9;
    function tick()
    {
        document.getElementById('decompte').innerText = 'Il reste ' + sec + ' seconde(s)';

        if(sec == 0)
        {
            document.getElementById('decompte').innerText = 'Terminé !';
            document.getElementById('cache').style.display = 'block';
            window.clearInterval(timer);
        }

        sec--;
    }
    var timer = window.setInterval(tick, 1000);
</script>


@endsection
