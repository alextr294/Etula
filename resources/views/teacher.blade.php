@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12">
                <div>
                    <h1>Séances</h1>
                    <br>
                    <div class="tbl-header teacher-header">
                        <table class="seance-tbl" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th>S&eacute;ance</th>
                                <th>Token</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content teacher-content">
                        <table class="seance-tbl table table-striped" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <th>
                                        &nbsp;-<a title="Séance" href="{{route('lessons.show', $lesson->id)}}">
                                            {{$lesson->name}}
                                        </a>
                                    </th>
                                    @if($lesson->token == null)
                                        <th><a href="{{ route('code', [$lesson->id]) }}">G&eacute;n&eacute;rer un token (+)</a></th>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <a class="btn btn-primary" href="{{route('lessons.create')}}">Créer une nouvelle séance</a>
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