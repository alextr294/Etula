@extends('layouts.app')
<meta http-equiv="refresh" content="10; url={{action('TokenController@delete',$token->lesson_id)}}">
@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <h1 id="decompte">Il reste 10 seconde(s)</h1>
                <br>
                <div class="col-md-12">
                    <div id="code-validation">
                        <h2>Code :</h2>
                        <p>{{$token->token}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

            // ajax: send delete method to server
        }

        sec--;
    }
    var timer = window.setInterval(tick, 1000);
</script>


@endsection
