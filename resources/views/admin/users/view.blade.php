@extends('layouts.admin')
@section('content')

<style>
#avg_rating i{
    color: #b3b0a7;
}
#avg_rating i.active{
    color: #F6BB18;
}
</style>

<section class="content-header">
    <h1>
    User view
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Info</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <table class="table table-condensed">
              <tbody>
              <tr>
                  <th> Image </th>
                  <td>
                    <img src="{{ \App\Hash::userImage('/images/users/', $user->image) }}" style="width: 190px; margin-bottom: 20px;
                    " class="previewHolder"/>
                  </td>
                </tr>
                <tr>
                  <th>ID</th>
                  <td>{{ $user->id }}</td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>{{ ucwords($user->role) }}</td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td>{{ ucwords($user->name) }}</td>
                </tr>
                
                <tr>
                  <th>Email</th>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>{{ $user->phone }}</td>
                </tr>
          
                <tr>
                  <th>Status</th>
                  <td>
                  @if($user->status == 1)
                <span class="label label-success">Active</span>
                @else
                <span class="label label-danger">Inactive</span>
                @endif
                  </td>
                </tr>

                <tr>
                  <th>Member since</th>
                  <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                  <td>
                  <a href="{{route('edituser', $user->id) }}" class="btn btn-success">Edit</a>
                  <a href="{{route('cpuser', $user->id) }}" class="btn btn-warning">Change Password</a>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>

    </div>
</section>  
@endsection     