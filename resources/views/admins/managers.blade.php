@extends('admins.layouts.admin_dashboard')
@section('title','Managers registered')
@section('adminLoged','Admin')
@section('comments',session('totalComments'))
@section('page','Managers')
@section('content')
<section class="content">
<div class="container">
    @if (session('status'))
    <div class="alert alert-success w-25">{{session('status')}}</div>
     @endif

    @if (session('error'))
    <div class="alert alert-danger w-25">{{session('error')}}</div>
    @endif
    <div>
        <a href="{{url('/admins/users/reg')}}" class="btn btn-primary">Add Manager</a>
    </div>
    <!-- Default box -->
<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">Managers</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-table projects">
          <thead>
              <tr>
                  <th style="width: 1%">

                  </th>
                  <th style="width: 20%">
                      Manager Name
                  </th>
                  <th style="width: 30%">
                      Email
                  </th>
                  <th>
                    Teams Assigned
                  </th>
                  <th style="width: 20%"  class="text-center">
                    Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach ($managers as $manager)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>
                    {{$manager['name']}}
                </td>
                <td>
                    {{$manager['email']}}
                </td>
                <td>
                    total teams
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{url('/admins/manager/info/'.$manager['user_id'])}}">
                        <i class="fas fa-eye">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="{{url('/admins/manager/editView/'.$manager['user_id'])}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm mt-2" href="{{url('/admins/manager/deleteUsers/'.$manager['user_id'])}}">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
<div class="text-center">
    {{$managers->links()}}
</div>

</div>
</section>
@endsection
