@extends('managers.layouts.manager_dashboard')
@section('title','Team details')
@section('comments',session('totalComments'))
@section('managerLoged','Manager')
@section('page','Team details')
@section('content')
<div class="container-fluid">
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of Team</h3>

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
                    <?php $teamDetails=get_object_vars($teamDetails);?>
                      <div> Team Name: <strong>{{$teamDetails['teamName']}}</strong></div>
                      <div class="mt-2">
                          Manager: <strong>{{$teamDetails['name']}}</strong>
                      </div>
                      <div class="mt-2">
                          Total Tasks:  <strong>{{$tasks}}</strong>
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
