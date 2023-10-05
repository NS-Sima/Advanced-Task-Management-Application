@extends('users.layouts.user_dashboard')
@section('title','Status changes')
@section('userLoged','User')
@section('page','Status Change')
@section('comments',session('totalComments'))
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
    <form action="{{url('/users/tasks/update_task/'.$task['task_id'])}}" method="POST" name="statusChange">
        @csrf
      <div class="row">
        <div class="col-md-6">
            <label>Task Title: {{$task['title']}}</label>
          <!-- /.form-group -->
          <div>
            @if ($task['status']==0)
            <label style="color:red">Status: {{"TODO"}} <b style="color: black;margin-left:20px;">0%</b></label>
            @elseif ($task['status']==1)
            <label style="color:blue">Status:{{"PROGRESS"}}  <b style="color: black;margin-left:20px;">70%</b></label>
            @else
            <label style="color:green">Status: {{ "COMPLETED"}} <b style="color: black;margin-left:20px;">100%</b></label>
            @endif
          </div>
          <!-- /.form-group -->

          <div class="mt-2">
            <label>End: {{$task['due_date']}}</label>
          </div>
          <div class="row form-group mt-4">
           <div class="col-2">
            Start
             <input type="radio" name="status"  class="form-control" required value="0">
           </div>
           <div class="col-2">
            Progess <input type="radio" name="status"  class="form-control" required value="1">
           </div>
           <div class="col-2">
            Finish <input type="radio" name="status"  class="form-control" required value="2">
           </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Task Description</label>
                <textarea name="desc" class="form-control rounded" rows="8" placeholder="Task Descriptions">
                   {{$task['description']}}
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
        <input type="submit" value="Continue" name="save" class="btn btn-outline-primary">
      </div>

    </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</section>
@endsection

