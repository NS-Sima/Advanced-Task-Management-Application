@extends('admins.layouts.admin_dashboard')
@section('title','Teams Created')
@section('comments',session('totalComments'))
@section('adminLoged','Admin')
@section('page','Teams')
@section('content')
<section class="content">
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
    @if (session('warning'))
    <div class="alert alert-warning w-25">
        {{session('warning')}}
    </div>
@endif
    <div class="container">
      <div>
        <a href="{{url('/admins/teams/reg_team')}}" class="btn btn-primary">Add Team</a>
    </div>
        <!-- Default box -->
    <div class="card mt-2">
        <div class="card-header">
          <h3 class="card-title">Teams</h3>

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
                      <th style="width: 35%">
                        Team Name
                      </th>
                      <th style="width: 35%">
                        Manager
                      </th>
                      <th style="width:29%"  class="text-center">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($teams as $team)
                <?php $team=get_object_vars($team);?>
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{$team['teamName']}}
                    </td>
                    <td>
                        {{$team['name']}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-primary btn-sm" href="{{url('/admins/team_details/'.$team['team_id'])}}">
                            <i class="fas fa-eye">
                            </i>
                            View
                        </a>
                        <a class="btn btn-info btn-sm" href="{{url('/admins/edit/team/'.$team['team_id'])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('/admins/delete/team/'.$team['team_id'])}}">
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
        {{$teams->links()}}
    </div>

    </div>
    </section>
@endsection
