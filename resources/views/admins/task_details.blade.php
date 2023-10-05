@extends('admins.layouts.admin_dashboard')
@section('title','Task details')
@section('comments',session('totalComments'))
@section('adminLoged','Admin')
@section('page','Task details')
@section('content')
<div class="container-fluid">
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of Task</h3>

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
                  <div class="col-10">
                      <div> Task Title: <strong></strong></div>
                      <div class="mt-2">
                        <?php $totalTeams=get_object_vars($totalTeams);?>
                          Teams: <strong>{{$totalTeams}}</strong>
                      </div>
                      <div class="mt-2">
                        <?php $totalUsers=get_object_vars($totalUsers);?>
                          Users: <strong>{{$totalUsers}}</strong>
                       </div>
                  </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </section>
</div>
@endsection
