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
        

        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Address</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              @if(!empty($address))
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <th>Address 1</th>
                  <td>{{ $address->address_1 }}</td>
                </tr>
                <tr>
                  <th>Address 2</th>
                  <td>{{ $address->address_2 }}</td>
                </tr>
                <tr>
                  <th>City</th>
                  <td>{{ $address->city }}</td>
                </tr>
                
                <tr>
                  <th>State</th>
                  <td>{{ $address->state }}</td>
                </tr>
                <tr>
                  <th>Zipcode</th>
                  <td>{{ $address->zipcode }}</td>
                </tr>
                <tr>
                  <th>Country</th>
                  <td>{{ $address->country }}</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>{{ $address->phone }}</td>
                </tr>
          
              </tbody>
            </table>
            @else
            <div class="alert alert-info">Company address could not be found!</div>
            @endif
          </div>
          <!-- /.box-body -->
        </div>

              <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Info</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              @if(!empty($company))
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <th>Name</th>
                  <td>{{ ucwords($company->name) }}</td>
                </tr>
                <tr>
                  <th>Tagline</th>
                  <td>{{ $company->tagline }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $company->description }}</td>
                </tr>
                
                <tr>
                  <th>Website</th>
                  <td>{{ $company->website }}</td>
                </tr>
                <tr>
                  <th>Facebook Link</th>
                  <td>{{ $company->facebook_link }}</td>
                </tr>
                <tr>
                  <th>Twitter Link</th>
                  <td>{{ $company->twitter_link }}</td>
                </tr>
                <tr>
                  <th>Linkedin Link</th>
                  <td>{{ $company->linkedin_link }}</td>
                </tr>
                <tr>
                  <th>Logo</th>
                  <td><img src="{{ \App\Hash::image('/images/companies/', $company->image) }}" width="150"></td>
                </tr>
          
              </tbody>
            </table>
            @else
            <div class="alert alert-info">Company info could not be found!</div>
            @endif
          </div>
          <!-- /.box-body -->
        </div>

    </div>
</section>  
@endsection     