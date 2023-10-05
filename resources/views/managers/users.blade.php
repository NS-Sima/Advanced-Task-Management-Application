@extends('managers.layouts.manager_dashboard')
@section('title','All Users')
@section('comments',session('totalComments'))
@section('managerLoged','Manager')
@section('page','Users list')
@section('content')
<section class="content">
    <div class="container">
        <!-- Default box -->
        @if (session('status'))
        <div class="alert alert-success w-25">
            {{session('status')}}
        </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger w-25">
                {{session('error')}}
            </div>
        @endif
    <div class="card mt-2">
        <div class="card-header">
          <h3 class="card-title">Users registered</h3>

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
                        #
                      </th>
                      <th style="width: 40%">
                          Full Name
                      </th>
                      <th style="width: 40%">
                          Email
                      </th>
                      <th style="width:19%"  class="text-center">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{$user['name']}}
                    </td>
                    <td>
                        {{$user['email']}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('/managers/users/info/'.$user['user_id'])}}">
                            <i class="fas fa-eye">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('/managers/users/editView/'.$user['user_id'])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm mt-2" href="{{url('/managers/users/deleteUsers/'.$user['user_id'])}}">
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
        {{$users->links()}}
    </div>
    </div>
    </section>
@endsection
