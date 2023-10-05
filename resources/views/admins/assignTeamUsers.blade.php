@extends('admins.layouts.admin_dashboard')
@section('title','Asign users to team')
@section('comments',session('totalComments'))
@section('adminLoged','Admin')
@section('page','Assign user to team')
@section('content')
<section class="content">
    <div class="container-fluid">
        <section class="content">
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
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Select users wants to asign to tasks</h3>

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
                    <div class="">
                        <label for="tableHeader">select team and Tick users you want to assign to it</label>
                        <form action="{{url('/admins/teams/asign_user/save')}}" method="POST" name="asignUsersTeam">
                            @csrf
                            <div class="form-group">
                                <label for="Team">Choose Team</label>
                                <select name="teams" id="teams" required class="form-control">
                                    <option value="">Select teams to assign to user</option>
                                    @foreach ($teams as $team)
                                    <option value="{{$team['team_id']}}">{{$team['teamName']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{session('category')}} Name: </th>
                                    <th class="text-center">
                                        <div>
                                            Tick here
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($users)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="user">{{ $user['name'] }}</td>
                                <td>
                                    <div class="form-group">
                                        <input type="checkbox" name="selectedUser[{{ $user['user_id'] }}]" class="form-control user-checkbox">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                                <tr>
                                    <td colspan="3">
                                        <input type="submit" name="submit" value="Assign" class="btn btn-outline-primary float-right">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </form>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </section>
    </div>
</section>
@endsection
