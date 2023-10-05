@extends('users.layouts.user_dashboard')
@section('title','User Index Page')
@section('userLoged','User')
@section('comments',session('totalComments'))
@section('page','Index')
@section('content')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$totalTasks}}</h3>

              <p>Teams</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('/users')}}" class="small-box-footer">More info<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><sup style="font-size: 20px">{{$totalTeams}}</sup></h3>

              <p>Tasks</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
</section>
@endsection
