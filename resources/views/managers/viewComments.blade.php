@extends('managers.layouts.manager_dashboard')
@section('title','All comments')
@section('managerLoged','Manager')
@section('comments',session('totalComments'))
@section('page','All comments')
@section('content')
<div class="container">
    <!-- Default box -->
<div class="card mt-2">
    <div class="card-header">
      <h3 class="card-title">All user comments</h3>

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
      <table class="table table-table">
          <thead>
              <tr>
                  <th style="width: 1%" class="text-center">
                    #
                  </th>
                  <th style="width: 20%" class="text-center">
                      Sender
                  </th>
                  <th style="width: 20%" class="text-center">
                    Task
                </th>
                  <th style="width: 20%" class="text-center">
                    Date/Time
                </th>
                  <th style="width: 20%" class="text-center">
                   Comment
                  </th>
                  <th style="width: 20%" class="text-center">
                    Attachment
                   </th>
              </tr>
          </thead>
          <tbody>
            @foreach ($comments as $comment)
            <?php $comment=get_object_vars($comment);?>
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">
                    {{$comment['name']}}
                </td>
                <td class="text-center">
                    {{$comment['title']}}
                </td>
                <td class="text-center">
                    {{$comment['created_at']}}
                </td>
                <td class="text-center">
                    <div style="color:blue">{{$comment['comment']}}</div>
                </td>
                <td>
                    <a href="{{asset('storage/Attachments/attachments/'.$comment['file_name'])}}" target="_blank">View Attachment</a>
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
    {{$comments->links()}}
</div>
</div>
</section>
@endsection
