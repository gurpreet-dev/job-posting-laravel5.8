@extends('layouts.admin')
@section('content')

<section class="content-header">
    <h1>Subscription Plans  <a href="{{ route('admin.add_plan') }}" class="btn btn-warning btn-xs">Add Subscription Plan</a></h1>
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
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->id }}</td>
                                <td>{{ $plan->title }}</td>
                                <td>{{ \App\Hash::price($plan->price) }}</td>
                                <td>
                                <a href="{{url('admin/plans/edit/'.$plan->id)}}" class="btn btn-xs btn-success">Edit</a>
                                <a href="{{ route('admin.delete_plan', [$plan->id]) }}" class="btn btn-xs btn-danger" onclick = "if (! confirm('Do you want to delete this plan?')) { return false; }">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>

@endsection