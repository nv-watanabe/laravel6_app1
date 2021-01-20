@extends('ajax.layout')

@section('css')
    <style>
        .container{
            padding: 0.5%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 style="margin-top: 12px;" class="alert alert-success">laravel 6 First Ajax CRUD Application - <a href="https://www.w3path.com" target="_blank" >W3path</a></h2><br>
        <div class="row">
            <div class="col-12">
                <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-user">Add User</a>
                <a href="https://www.w3path.com/jquery-submit-form-ajax-php-laravel-5-7-without-page-load/" class="btn btn-secondary mb-2 float-right">Back to Post</a>
                <table class="table table-bordered" id="laravel_crud">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <td colspan="2">Action</td>
                    </tr>
                    </thead>
                    <tbody id="users-crud">
                    @foreach($users as $u_info)
                        <tr id="user_id_{{ $u_info->id }}">
                            <td>{{ $u_info->id  }}</td>
                            <td>{{ $u_info->name }}</td>
                            <td>{{ $u_info->email }}</td>
                            <td colspan="2">
                                <a href="javascript:void(0)" id="edit-user" data-id="{{ $u_info->id }}" class="btn btn-info mr-2">Edit</a>
                                <a href="javascript:void(0)" id="delete-user" data-id="{{ $u_info->id }}" class="btn btn-danger delete-user">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @include('ajax.modal')
@endsection

@section('js')
<script>
    $(document).ready(function () {
        let body = ('body');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#create-new-user').click(function () {
            $('#btn-save').val('create-user');
            $('#userForm').trigger('reset');
            $('#userCrudModal').html("Add New User");
            $('#ajax-crud-modal').modal('show');
        });

        $(body).on('click', '#edit-user', function () {
            let user_id = $(this).data('id');
            $.get('ajax-crud/' + user_id + '/edit', function (data) {
                $('#userCrudModal').html("Edit User");
                $('#btn-save').val("edit-user");
                $('#ajax-crud-modal').modal('show');
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
            })
        });

        $(body).on('click', '.delete-user', function () {
            let user_id = $(this).data("id");
                if(confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('ajax-crud')}}" + '/' + user_id,
                        success: function (data) {
                            $("#user_id_" + user_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });

        if ($("#userForm").length > 0) {
            $(this).validate({
                submitHandler: function(form) {
                    let actionType = $('#btn-save').val();
                    $('#btn-save').html('Sending..');

                    $.ajax({
                        data: $('#userForm').serialize(),
                        url: "{{ route('ajax-crud.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            let user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
                            user += '<td colspan="2"><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info mr-2">Edit</a>';
                            user += '<a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user ml-1">Delete</a></td></tr>';


                            if (actionType == "create-user") {
                                $('#users-crud').prepend(user);
                            } else {
                                $("#user_id_" + data.id).replaceWith(user);
                            }

                            $('#userForm').trigger("reset");
                            $('#ajax-crud-modal').modal('hide');
                            $('#btn-save').html('Save Changes');

                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#btn-save').html('Save Changes');
                        }
                    });
                }
            })
    }
</script>
@endsection
