@extends('admins.layouts.admin_dashboard')
@section('title','Asign users to Task')
@section('comments',session('totalComments'))
@section('adminLoged','Admin')
@section('page','Assign user')
@section('content')
<section class="content">
    <div class="container-fluid">
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Select {{session('category')}}</h3>

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
                        <label for="tableHeader">Tick {{session('category')}} you want to assign</label>
                        <form action="{{url('/tasks/assign_task_participants')}}" method="POST" name="asignTask">
                            @csrf
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
                                @if ($teams && session('type')=='team')
                                @foreach ($teams as $team)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="team">{{ $team['teamName'] }}</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="checkbox" name="selectedTeam[{{ $team['team_id'] }}]" class="form-control team-checkbox">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            @if ($users && session('type')=='user')
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
                                        <input type="submit" name="submit" value="Assign Task" class="btn btn-outline-primary float-right">
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
