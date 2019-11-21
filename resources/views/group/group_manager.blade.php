{{-- $groups array(Group) --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                {{-- Group name --}}
                <div class="card">
                    <div class="card-header">
                        <h3>Group Manager</h3>
                        <button class="btn btn-primary" onclick="window.location.href='{{action('GroupController@create')}}'">Create new</button>
                    </div>
                    <div class="card-body">
                        @if(count($groups))
                            <ul>
                                @foreach($groups as $group)
                                    <li class="p-2">
                                        {{$group->name}}
                                        <button class="btn btn-outline-primary" onclick="showGroup()">Info</button>
                                        <button class="btn btn-outline-danger" onclick="deleteGroup('{{action('GroupController@destroy',$group->id)}}',{{$group->id}})">Delete</button>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="p-2 text-dark">Database does not have any group</p>
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