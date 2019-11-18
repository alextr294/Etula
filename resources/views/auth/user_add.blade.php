@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a new user</div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('users.store') }}">
                        {!! csrf_field() !!}

                        {{-- NAME INPUT --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Name</label>
                            <div class="col-lg-6">
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

                        {{-- EMAIL INPUT --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">E-Mail Address</label>
                            <div class="col-lg-6">
                                <input type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- PASSWORD INPUT --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Password</label>
                            <div class="col-lg-6">
                                <input type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password"
                                       required>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label text-lg-right">Confirm Password</label>
                            <div class="col-lg-6">
                                <input type="password"
                                       class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                       name="password_confirmation"
                                       required>
                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- USER TYPE INPUT --}}
                        <div class="form-group row text-center">
                            {{-- Admin Select Button --}}
                            <div class="col-md-4 radio-btn">
                                <input type="radio" id="admin-button" name="type" value="admin" checked />
                                <label for="admin-button">Admin</label>
                            </div>
                            {{-- Teacher Select Button --}}
                            <div class="col-md-4 radio-btn">
                                <input type="radio" id="teacher-button" name="type" value="teacher" checked />
                                <label for="teacher-button">Teacher</label>
                            </div>
                            {{-- Student Select Button --}}
                            <div class="col-md-4 radio-btn">
                                <input type="radio" id="student-button" name="type" value="student" checked />
                                <label for="student-button">Student</label>
                            </div>
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-primary">
                                    Add user
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection