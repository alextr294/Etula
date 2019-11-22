@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <form action="{{ route('token_validate')}}" method="POST">
                    {{ csrf_field() }}
                    <h3>Valider ma présence</h3>

                    <div class="">
                        <input id="token" type="text" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" value="{{ $token }}">
                        @if ($errors->has('token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('token') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input id="token" type="text" class="form-control" name="token" value="{{ $token }}">
                    <br>

                    @if(session('success')!=null)
                        <p style="color:green;font-weight:bold;">{{session('success')}}</p>
                    @elseif(session('danger')!=null)
                        <p style="color:red;font-weight:bold;">{{session('danger')}}</p>
                    @elseif(session('warning')!=null)
                        <p style="color:orange;font-weight:bold;">{{session('warning')}}</p>
                    @endif

                    <button type="submit" class="btn btn-primary float-right">Valider</button>
                </form>
                <br>
            </div>
        </div>
    </div>
@endsection
