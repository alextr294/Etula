{{-- $groups array(Group) --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                {{-- Group name --}}
                <div class="card">
                    <div class="card-header">
                        <h3>Gestionnaire de groupes</h3>
                        <button class="btn btn-primary" onclick="window.location.href='{{action('GroupController@create')}}'">Cr&eacute;er un nouveau groupe</button>
                    </div>
                    <div class="card-body">
                        @if(count($groups))
                            <ul>
                                @foreach($groups as $group)
                                    <li class="p-2">
                                        {{$group->name}}
                                        <button class="btn btn-outline-primary" onclick="showGroup()">Infos</button>
                                        <button class="btn btn-outline-danger" onclick="deleteGroup('{{action('GroupController@destroy',$group->id)}}',{{$group->id}})">Supprimer</button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="p-2 text-dark">La base de données ne contient aucun groupe.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>

    @if(count($groups))
        <script type="text/javascript">
            function showGroup() {
                window.location.href ='{{action('GroupController@show',$group->id)}}';
            }

            function deleteGroup(url,idGroup) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{idGroup: idGroup },
                    dataType: 'json',
                    success:function(response){
                        alert(response.message);
                        window.location.href = '{{action("GroupController@index")}}';
                    },
                    error:function (response) {
                        alert(response.message);
                    }
                });
            }
        </script>
    @endif
@endsection