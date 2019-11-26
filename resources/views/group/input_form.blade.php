@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cr&eacute;er un nouveau groupe d'alternants</div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{action('GroupController@store')}}">
                            {!! csrf_field() !!}

                            {{-- NAME INPUT --}}
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label">Nom*</label>
                                <div class="col-md-8">
                                    <input type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <p style="margin: auto;">* : champs obligatoires.</p>
                            </div>

                            {{-- SUMMIT BUTTON --}}
                            <button type="submit" class="btn btn-primary">Cr&eacute;er</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection