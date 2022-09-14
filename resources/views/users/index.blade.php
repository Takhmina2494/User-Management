@extends('layouts.app')
@section('title', 'Users')
<style>
    div.dataTables_wrapper div.dataTables_length select {
        width:50% !important;
    }
</style>
@section('content')
<div class="card">
    <div class="card-header text-white" style="background:#334f9e">
        <h3>User Management System
        <span style="float:right;">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_user">
            <i class="fa fa-user-plus" aria-hidden="true"></i> User
            </button>
        </span>
        </h3>
    </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped" id="users_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Joining</th>
                    <th>Experience</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                        @if($user->profile_image != null)
                            <img src="{{ asset($user->profile_image) }}" alt="Profile Image" style="height:60px;border-radius:50px;">
                        @else
                            @if($user->gender == 'M' || $user->gender == 'N')
                                <img src="{{ asset('storage\user_images\m_avatar.png')}}" alt="Profile Image" style="width:60px;height:60px;border-radius:50px;">
                            @else
                            <img src="{{ asset('storage\user_images\f_avatar.png')}}" alt="Profile Image" style="width:60px;height:60px;border-radius:50px;">
                            @endif
                        @endif
                        </td> 
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Carbon\Carbon::parse($user->date_of_joining)->format('d-m-Y') }}</td>
                        <td>
                            @if($user->date_of_leaving == null)
                            {{Carbon\Carbon::create($user->date_of_joining)->diff(Carbon\Carbon::now())->format('%y Year %m Months')}}
                            @else
                            {{Carbon\Carbon::create($user->date_of_joining)->diff(Carbon\Carbon::create($user->date_of_leaving))->format('%y Year %m Months')}}
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update{{$user->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <!-- Delete Modal -->
                        <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden="true"></i> Confirm Delete!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure, you want to delete this user?</p>
                                        <ul>
                                            <li><b>Name:</b> {{ $user->name }}</li>
                                            <li><b>Email:</b> {{ $user->email }}</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                        <form action="{{ route('user-management.destroy',$user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- update user modal -->
                        @include('users.update_modal')
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
  </div>
</div>
@include('users.create_modal')
@endsection
@section('pagejs')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#users_table').DataTable();
    });
</script>
<!-- automatically open create user modal if any error occurs -->
@if ($errors->createUser->any())
<script>
    var myModal = new bootstrap.Modal(document.getElementById("create_user"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
</script>
@endif
<!-- automatically open update user modal if any error occurs -->
@forelse($users as $user)
    <?php $id= $user->id; ?>
    @if ($errors->$id->any())
    <script>
        var myModal = new bootstrap.Modal(document.getElementById("update{{$id}}"), {});
            document.onreadystatechange = function () {
                myModal.show();
            };
    </script>
    @endif
@empty
@endforelse
@endsection