@extends('managers.layouts.manager_dashboard')
@section('title','users informations')
@section('comments',session('totalComments'))
@section('managerLoged','Manager')
@section('page','users info')
@section('content')
<div class="container-fluid">
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of users</h3>

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
                      <div>Full Name: <strong>{{$manager['name']}}</strong></div>
                      <div class="mt-2">
                          Role: <strong>{{$manager['role']}}</strong>
                      </div>
                      <div class="mt-2">
                          Total Tasks:  <strong>{{$tasks}}</strong>
                       </div>
                       <div class="mt-2">
                        Total Teams:  <strong>{{$countedTeams}}</strong>
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
