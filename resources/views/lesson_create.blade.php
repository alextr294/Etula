<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form action="{!! url('lesson_create') !!}" method="POST">

                        {{ csrf_field() }}

                        <h4>Ajouter un cours</h4>


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nom du cours</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type de cours</label>

                            <div class="col-md-6">
                                <select name=type>
                                    <option value="CM">CM</option>
                                    <option value="TD">TD</option>
                                    <option value="TP">TP</option>
                                </select>

                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <br>

                        <div class="form-group{{ $errors->has('begin_at') ? ' has-error' : '' }}">
                            <label for="begin_at" class="col-md-4 control-label">Début du cours</label>

                            <div class="col-md-6">
                                <input type="datetime-local" id="begin_at" type="text" class="form-control" name="begin_at" value="{{ old('begin_at') }}" required autofocus>

                                @if ($errors->has('begin_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('begin_at') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                            <label for="end_at" class="col-md-4 control-label">Fin du cours</label>

                            <div class="col-md-6">
                                <input type="datetime-local" id="end_at" type="text" class="form-control" name="end_at" value="{{ old('end_at') }}" required autofocus>

                                @if ($errors->has('end_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_at') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                            <label for="unit" class="col-md-4 control-label">UE</label>

                            <div class="col-md-6">
                                <select name=unit>
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

                        <br>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="col-md-1">
                                    <button id="envoyer" name="envoyer" type="submit">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
