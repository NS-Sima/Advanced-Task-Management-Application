@extends('managers.layouts.manager_dashboard')
@section('title','Edit Task specifi task')
@section('managerLoged','Manager')
@section('comments',session('totalComments'))
@section('page','Edit task')
@section('content')
<section class="content">
<div class="container-fluid">
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Edit task of specific individual</h3>

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
    <form action="{{url('/managers/tasks/update_task/'.$taskInfo['task_id'])}}" method="POST" name="editOwnTasks">
        @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Task Title</label>
            <input type="text" name="title" id="name" value="{{$taskInfo['title']}}" placeholder="Task Title" class="form-control">
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Task Priority</label>
            <select name="priority" class="form-control select2 text-center" style="width: 100%;" required>
              <option selected="selected" value="">Task Priority</option>
              <option value="1">High</option>
              <option value="2">Medium</option>
              <option value="3">Low</option>
            </select>
          </div>
          <!-- /.form-group -->

          <div class="form-group mt-2">
            <label>Due Date</label>
            <input type="date" name="dua_date" value="{{$taskInfo['due_date']}}"id="date" required class="form-control">
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Task Description</label>
                <textarea name="desc" class="form-control rounded" rows="8" placeholder="Task Descriptions">
                   {{$taskInfo['description']}}
                </textarea>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        @if (session('status'))
        <div class="alert alert-success w-50">{{session('status')}}</div>
         @endif

        @if (session('error'))
        <div class="alert alert-danger w-50">{{session('error')}}</div>
        @endif
      <!-- /.form-group -->
      </div>
      <!-- /.row -->
      <div class="form-group mt-2 float-right">
        <input type="submit" value="Save" name="save" class="btn btn-outline-primary">
      </div>

    </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</section>
@endsection

