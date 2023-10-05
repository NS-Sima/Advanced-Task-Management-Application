@extends('admins.layouts.admin_dashboard')
@section('title','Update user info')
@section('adminLoged','Admin')
@section('comments',session('totalComments'))
@section('page','Editu user')
@section('content')
<section class="content">
<div class="container-fluid">
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Users updation : You can reset a role, name and email</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form action="{{url('/admins/manager/update_users/'.$user['user_id'])}}" method="POST" name="edit_user">
        @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{$user['name']}}" required placeholder="Full Name" class="form-control">
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Select Role</label>
            <select name="role" class="form-control select2" style="width: 100%;" required>
              <option selected="selected" value="">Select Role</option>
              <option value="manager">Manager</option>
              <option value="user">Normal User</option>
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{$user['email']}}" required placeholder="Email address" class="form-control">
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Default Password</label>
            <input type="password" name="password" id="password" readonly value="1234" class="form-control">
          </div>
        </div>
        <!-- /.col -->
        @if (session('success'))
        <div class="alert alert-success w-25">{{session('success')}}</div>
         @endif

        @if (session('error'))
        <div class="alert alert-danger w-25">{{session('error')}}</div>
        @endif
      <!-- /.form-group -->
      </div>
      <!-- /.row -->
      <div class="form-group mt-2 float-right">
        <input type="submit" value="Edit User" name="save" class="btn btn-outline-primary">
      </div>

    </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</section>
@endsection

