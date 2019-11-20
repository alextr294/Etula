@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cr&eacute;er une nouvelle unit&eacute; d'enseignement</div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{url('/courses')}}">
                        {!! csrf_field() !!}

                        {{-- NAME INPUT --}}
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label">Nom</label>
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

                        {{-- GROUP SELECT --}}
                        <div class="form-group row">
                            <label for="group-input" class="col-md-4 col-form-label">Group</label>
                            <label for="group-input" class="col-md-4 col-form-label">Groupe</label>
                            <div class="col-md-8">
                                <select id="group-input" name="group_id" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                                    <option value="" selected>...</option>
                                    @if(count($groups) > 0)
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('group_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        {{-- SUMMIT BUTTON --}}
                        <button type="submit" class="btn btn-primary float-right">Cr&eacute;er</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection