@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ajouter un cours</div>
                    <div class="card-body">
                        <form action="{{route('lessons.store')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
                                <label for="name" class="col-md-4 control-label col-lg-4 col-form-label">Nom du cours</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }} row">
                                <label for="type" class="col-md-4 control-label col-lg-4 col-form-label">Type de cours</label>
                                <div class="col-md-12">
                                    <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}">
                                        @foreach($types as $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('begin_at') ? ' has-error' : '' }} row">
                                <label for="begin_at" class="col-md-4 control-label col-lg-4 col-form-label">Début du cours</label>
                                <div class="col-md-12">
                                    <input type="datetime-local" id="begin_at" class="form-control" name="begin_at" value="{{ old('begin_at') }}" required autofocus>
                                    @if ($errors->has('begin_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('begin_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- begin at input --}}
                            <div class="form-group{{ $errors->has('begin_at') ? ' has-error' : '' }} row">
                                <label for="begin_at" class="col-md-4 control-label col-lg-4 col-form-label">Début du cours</label>
                                <div class="col-md-12">
                                    <div class="row text-center">
                                        {{-- date --}}
                                        <input type="date" id="begin_at" class="form-control col-md-6" name="begin_at" value="{{ old('begin_at') }}" required autofocus>
                                        @if ($errors->has('begin_at'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('begin_at') }}</strong>
                                            </span>
                                        @endif
                                        {{-- time --}}
                                        <input type="text" id="begin_at_time" class="form-control col-md-6" name="begin_at_time" value="{{ old('begin_at_time') }}" required autofocus>
                                        @if ($errors->has('begin_at_time'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('begin_at_time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }} row">
                                <label for="end_at" class="col-md-4 control-label col-lg-4 col-form-label">Fin du cours</label>
                                <div class="col-md-12">
                                    <div class="row text-center">
                                        {{-- date --}}
                                        <input type="date" id="end_at" class="form-control col-md-6" name="end_at" value="{{ old('end_at') }}" required autofocus>
                                        @if ($errors->has('end_at'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_at') }}</strong>
                                            </span>
                                        @endif
                                        {{-- time --}}
                                        <input type="text" id="end_at_time" class="form-control col-md-6" name="end_at_time" value="{{ old('end_at_time') }}" required autofocus>
                                        @if ($errors->has('end_at_time'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('end_at_time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }} row">
                                <label for="unit" class="col-md-4 control-label col-lg-4 col-form-label">UE</label>
                                <div class="col-md-12">
                                    <select name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                    @endif
                                    </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 col-lg-offset-4">
                                    <button id="envoyer" class="btn btn-primary float-right" name="envoyer" type="submit">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <script type="text/javascript">
        let time_picker = new TimePicker(['begin_at_time','end_at_time'], {
            lang: 'en',
            theme: 'dark'
        });

        time_picker.on('change', function(evt) {
            evt.element.value = (evt.hour || '00') + ':' + (evt.minute || '00');
        });
    </script>
@endsection
