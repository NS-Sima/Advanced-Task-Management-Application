@extends('users.layouts.user_dashboard')
@section('title','My Teams')
@section('userLoged','User')
@section('page','My Teams')
@section('comments',session('totalComments'))
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
