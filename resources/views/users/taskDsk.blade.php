@extends('users.layouts.user_dashboard')
@section('title','Task details')
@section('userLoged','User')
@section('comments',session('totalComments'))
@section('page','Task descriptions')
@section('content')
<div class="container-fluid">
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of Tasks</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-8">{{$task['description']}}</div>
                    <div class="col-4">
                        <a class="btn btn-info btn-sm float-right" href="{{url('/users/tasks/edit_status/'.$task['task_id'])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Starter
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </section>
</div>
@endsection
