@extends('users.layouts.user_dashboard')
@section('title','Comment on task')
@section('userLoged','User')
@section('page','Comment task')
@section('comments',session('totalComments'))
@section('content')
<div class="container-fluid">
    <section class="content">
        <!-- Default box -->
        @if (session('status'))
        <div class="alert alert-success w-50">
            {{session('status')}}
        </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger w-50">
                {{session('error')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Provide comments or opinion on task</h3>

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
                <table class="table table">
                    <form action="{{url('users/send-comments/')}}" method="POST" name="comment" enctype="multipart/form-data">
                        @csrf
                    <tr >Comment as: <b style="color:green">{{session('as')}}</b>
                    </tr>
                    <tr>
                        <div>
                            <label for="task">Task to comment</label>
                            <select name="task" id="task" class="form-control select2" required>
                                <option value="">Choose task to share comments</option>
                                @foreach ($tasks as $task)
                                <?php $task=get_object_vars($task);?>
                                    <option value="{{$task['task_id']}}">{{ $loop->iteration.". ".$task['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group mt-2">
                            <textarea name="comment" class="form-control rounded" rows="8" placeholder="Place your comments here">

                             </textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="Files">Attach File (<small>option</small>): </label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <input type="submit" name="save" id="save" value="Send" class="btn btn-outline-primary">
                        </div>
                    </tr>
                </form>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </section>
</div>
@endsection
