@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Dashboard</h1>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Doctors</span>
              <span class="info-box-number">{{ $data['doctors'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Applicants</span>
              <span class="info-box-number">{{ $data['applicants'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-rss"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jobs</span>
              <span class="info-box-number">{{ $data['jobs'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Subscribed Users</span>
              <span class="info-box-number">{{ $data['subscribed_users'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">

        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(!$data['latest_users']->isEmpty())
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data['latest_users'] as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ ucwords($user->role) }}</td>
                    <td>{{ ucwords($user->name) }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <a href="{{ route('viewuser', [$user->id])}}" class="btn btn-xs btn-warning">View</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
              @else
              <div class="alert alert-warning">No Users Found!</div>
              @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{ route('adduser')}}" class="btn btn-sm btn-info btn-flat pull-left">Add New User</a>
              <a href="{{ route('admin.users') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>

        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Posted Jobs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(!$data['latest_jobs']->isEmpty())
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Job</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data['latest_jobs'] as $data)
                  <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ ucwords($data->user->role) }}</td>
                    <td>{{ ucwords($data->title) }}</td>
                    <td>
                      <a href="{{ route('admin.job-view', [$data->id])}}" class="btn btn-xs btn-warning">View</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
              @else
              <div class="alert alert-warning">No Jobs Found!</div>
              @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{ route('admin.jobs') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Jobs</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>

      </div>

     
    </section>
    <!-- /.content -->

@endsection