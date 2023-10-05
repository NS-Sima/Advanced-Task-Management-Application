@extends('managers.layouts.manager_dashboard')
@section('title','Edit Teams')
@section('comments',session('totalComments'))
@section('managerLoged','Manager')
@section('page','Edit Teams')
@section('content')
<section class="content">
<div class="container-fluid">
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Edit Team informations</h3>

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
    <form action="{{url('/managers/update_team_info/'.$team['team_id'])}}" method="POST" name="edit_team_info">
        @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Team Name</label>
            <input type="text" name="name" id="name" value="{{$team['teamName']}}" placeholder="Team Name" class="form-control" required>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Select Manager</label>
            <select name="manager" class="form-control select2" style="width: 100%;" required>
              <option selected="selected" value="">Manager assigned</option>
              @foreach ($managers as $manager)
              <option value="{{$manager->user_id}}">{{$manager->name}}</option>
              @endforeach
            </select>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="form-group">
            <label>Team descriptions</label>
                <textarea name="desc" class="form-control rounded" rows="5" required placeholder="Edit decriptions">
                    {{$team['descriptions']}}
                </textarea>
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        @if (session('status'))
        <div class="alert alert-success w-50">{{session('status')}}</div>
         @endif

        @if (session('error'))
        <div class="alert alert-error w-50">{{session('error')}}</div>
        @endif
      <!-- /.form-group -->
      </div>
      <!-- /.row -->
      <div class="form-group mt-2 float-right">
        <input type="submit" value="save" name="save" class="btn btn-outline-primary">
      </div>

    </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
</section>
@endsection

