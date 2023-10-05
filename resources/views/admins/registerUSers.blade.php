@extends('admins.layouts.admin_dashboard')
@section('title','Register Users')
@section('comments',session('totalComments'))
@section('adminLoged','Admin')
@section('page','Register users')
@section('content')
<section class="content">
<div class="container-fluid">
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Users Registration</h3>

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
    <form action="{{url('/admins/users/reg/new_user')}}" method="POST" name="registerUsers">
        @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" id="name" required placeholder="Full Name" class="form-control">
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
            <input type="email" name="email" id="email" required placeholder="Email address" class="form-control">
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Default Password</label>
            <input type="password" name="password" id="password" readonly value="1234" class="form-control">
          </div>
        </div>
        <!-- /.col -->
        @if (session('success'))
        <div class="alert alert-success w-50">{{session('success')}}</div>
         @endif

        @if (session('error'))
        <div class="alert alert-error w-50">{{session('error')}}</div>
        @endif
      <!-- /.form-group -->
      </div>
      <!-- /.row -->
      <div class="form-group mt-2 float-right">
        <input type="submit" value="Register" name="save" class="btn btn-outline-primary">
      </div>

    </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</section>
@endsection

