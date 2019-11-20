{{-- $members: array(User) list of all members in group --}}
{{-- $group: Group --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                {{-- Group name --}}
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Group <u>{{$group->name}}</u></h3>
                        <div class="row d-inline-block">
                            <a class="col-lg-4 mr-2 btn btn-outline-primary" href="{{route('groups.index')}}">Back to Manager</a>
                            <a class="col-lg-4 ml-2 btn btn-primary" href="{{route('group_add_student_form',$group->id)}}">Add new Member</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Members</div>
                    <div class="card-body">
                        <ul>
                            @foreach($members as $member)
                                <li class="p-2">
                                    {{$member->name}}
                                    <button class="btn btn-primary" onclick="window.location.href='{{action('UserController@show',$member->id)}}';">Info</button>
                                    <button class="btn btn-outline-danger"
                                            onclick="remove_action('{{action('GroupController@remove_student',array('idGroup'=>$group->id,'idStudent'=>$member->id))}}')"
                                    >Delete</button>
                                </li>
                            @endforeach
                        </ul>
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

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function remove_action(url) {
            $.ajax({
                type:'DELETE',
                url: url,
                dataType:'json',
                success:function(response){
                    alert(response.message);
                    window.location.reload(true);
                },
                error:function (response) {
                    alert(response.message);
                }
            })
        }
    </script>
@endsection