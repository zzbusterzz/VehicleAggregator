@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <style type="text/css">
            .box{
                width:600px;
                margin:0 auto;
                border:1px solid #ccc;
            }
            </style>
    </head>

    <body id="main_body">

        @section('navbarButtons')
        {{-- https://stackoverflow.com/questions/38709886/call-route-from-button-click-laravel --}}
        <li><a href="{{ route('customerdashboard') }}">Dashboard</a></li>{{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('customerbookservice') }}">Book a Service</a></li>
        <li><a href="{{ route('customershowbookings') }}">Completed Requests</a></li>
        <li><a href="{{ route('customerplaceorder') }}">Order Part</a></li>
        @endsection

        @php
            $data = \App\Customer::select('firstname', 'lastname','phone','email')
                        ->where('id', Session::get('user_id'))
                        ->get();
        @endphp

        {{-- https://www.digitalocean.com/community/tutorials/how-to-implement-password-verification-using-laravel-form-request --}}
        <form action="/updateProfile" method="POST">
            {{csrf_field()}}
            <div class="panel panel-default" style="margin-top:40px">
                <div class="panel-heading"><h4>Profile</h4></div>

                @if (session('infoprofile'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('infoprofile') }}
                        </div>
                    </div>
                </div>
                @elseif (session('errorprofile'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('errorprofile') }}
                        </div>
                    </div>
                </div>
                @endif

                <div class="panel-body">
                    <div class="form-group">
                        <h6 style="color:blue;">Username : </h6>
                        <input type="text" name="username" class="form-control" value= {{ Session::get('user_name') }} disabled/>
                    </div>

                    <div class="form-group">
                        <h6 style="color:blue;">First Name : </h6>
                        <input id="fname" type="text" name="fname" value = {{ $data[0]->firstname }} class="form-control"/>
                    </div>

                    <div class="form-group">
                        <h6 style="color:blue;">Last Name : </h6>
                        <input id="lname" type="text" name="lname" value = {{ $data[0]->lastname }} class="form-control"/>
                    </div>

                    <div class="form-group">
                        <h6 style="color:blue;">Phone</h6>
                        <input id="phone" type="text" name="phone" value = {{ $data[0]->phone }} class="form-control"/>
                    </div>

                    <div class="form-group">
                        <h6 style="color:blue;">Email</h6>
                        <input id="email" type="text" name="email" value = {{ $data[0]->email }} class="form-control"/>
                    </div>

                    <div class="form-group">
                        <input id="updprof" type="submit" name="UpdateProfile" value="Update Profile" class="btn btn-primary"/>
                    </div>
                </div>
            </div>
        </form>

        <form action="/updatePassword" method="POST">
            {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Password</h4></div>
                                
                @if (session('infopwd'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('infopwd') }}
                        </div>
                    </div>
                </div>
                @elseif (session('errorpwd'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session('errorpwd') }}
                        </div>
                    </div>
                </div>
                @endif

                <div class="panel-body">
                    <div class="form-group">
                        <h6 style="color:blue;">Old Password : </h6>
                        <input id="old_password" type="password" name="old_password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <h6 style="color:blue;">New Password : </h6>
                        <input id="new_password" type="password" name="new_password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <h6 style="color:blue;">Confirm Password : </h6>
                        <input id="confirm_password" type="text" name="confirm_password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input id="updpass" type="submit" name="UpdatePassword" value="Update Password" class="btn btn-primary"/>
                    </div>
                </div>
            </div>
        </form>
    </body>
@endsection