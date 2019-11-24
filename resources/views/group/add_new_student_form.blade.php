{{-- $group Group --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-8">
                {{-- Group name --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row text-center">
                            <h3 class="col-md-6">Add new Member to group <u>{{$group->name}}</u></h3>
                            <a class="col-md-2 btn btn-outline-primary ml-4" href="{{action('GroupController@show',$group->id)}}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            {{-- Student Search Input --}}
                            <label for="student-name-input" class="col-md-4 col-form-label text-right">Student Name</label>
                            <div class="col-md-8">
                                <input id="student-name-input"
                                       type="text"
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

                        {{-- Student Search Results --}}
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>...</th>
                                </tr>
                            </thead>

                            <tbody id="student-search-result">

                            </tbody>
                        </table>
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

        $('#student-name-input').on('keyup',function () {
           let student_name = $(this).val();
           let url = '{{route('group_search_student',$group->id)}}?key='+student_name;

           $.ajax({
               type:'GET',
               url:url,
               success:function(response){
                   let search_result = $('#student-search-result');
                   search_result.html(response);
               },
               error:function (response) {
                   alert(response.message);
               }
           })
        });

        function add_action(e) {
            let value_id = $(e).attr('data-value');
            $.ajax({
                type:'POST',
                url:'{{route('group_add_student',$group->id)}}',
                dataType:'json',
                data:{ student_id: value_id },
                success:function(response) {
                    alert(response.message);
                    $(e).prop('disabled',true);
                },
                error:function(response) {
                    alert(response.message);
                }
            });
        }
    </script>
@endsection