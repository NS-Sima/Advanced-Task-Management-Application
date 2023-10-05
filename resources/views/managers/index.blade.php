@extends('managers.layouts.manager_dashboard')
@section('title','Manager Index Page')
@section('comments',session('totalComments'))
@section('managerLoged','Manager')
@section('page','Index')
@section('content')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$managers}}<sup style="font-size: 20px"></sup></h3>

              <p>Managers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/managers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$teams}}</h3>

              <p>Teams</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('/managers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{$users}}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('/managers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
</section>
@endsection
