@extends('users.layouts.user_dashboard')
@section('title','Your tasks tasks')
@section('userLoged','User')
@section('comments',session('totalComments'))
@section('page','Your tasks')
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success w-25">{{session('status')}}</div>
     @endif

    @if (session('error'))
    <div class="alert alert-danger w-25">{{session('error')}}</div>
    @endif
    <!-- Default box -->
<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">Your Tasks</h3>

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
                  <th style="width: 1%" class="text-center">
                    #
                  </th>
                  <th style="width: 20%" class="text-center">
                     Task Title
                  </th>
                  <th style="width: 20%" class="text-center">
                    Priority
                </th>
                  <th style="width: 20%" class="text-center">
                   Due date
                  </th>
                  <th style="width: 20%" class="text-center">
                    Status
                   </th>
                  <th style="width: 19%" class="text-center">
                    Action
                  </th>
              </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $task)
            <?php $task=get_object_vars($task);?>
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">
                    {{$task['title']}}
                </td>
                <td class="text-center">
                    @if ($task['priority']==1)
                        <div style="color:red">High</div>
                    @elseif ($task['priority']==2)
                        <div style="color:blue">Medium</div>
                    @else
                    <div style="color:green">Low</div>
                    @endif
                </td>
                <td class="text-center">
                    {{$task['due_date']}}
                </td>
                <td class="text-center">
                    @if ($task['status']==0)
                        <div style="color:red">TODO</div>
                    @elseif ($task['status']==1)
                    <div style="color:blue">PROGRESS</div>
                    @elseif ($task['status']==2)
                    <div style="color:green">COMPLETED</div>
                    @endif
                </td>
                <td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="{{url('/users/tasks/view/'.$task['task_id'])}}">
                        <i class="fas fa-eye">
                        </i>
                        Descr
                    </a>
                    <a class="btn btn-info btn-sm" href="{{url('/users/tasks/edit_status/'.$task['task_id'])}}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Starter
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
    {{$tasks->links()}}
</div>
</div>
</section>
@endsection
