@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Course</div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{url('/courses')}}">
                        {!! csrf_field() !!}

                        {{-- NAME INPUT --}}
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label">Name</label>
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
                            <label for="" class="col-md-4 col-form-label">Group</label>
                            <div class="col-md-8">
                                <select name="group_id" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }}">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('group_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('group_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- SUMMIT BUTTON --}}
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection