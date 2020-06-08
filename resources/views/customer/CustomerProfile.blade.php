@php( $services = \App\Service::all())

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
        @endsection

        <div class="container" style="margin-top:30px">
            <h3>Profile</h3>
        </div>

        <div class="form-group">
            <h6 style="color:blue;">Name : </h6>
            <input type="text" name="name" class="form-control"/>
        </div>
        <div class="form-group">
            <h6 style="color:blue;">Username : </h6>
            <input type="text" name="username" class="form-control"/>
        </div>
        <div class="form-group">
            <h6 style="color:blue;">Phone</h6>
            <input type="text" name="phone" class="form-control"/>
            <a href="">Edit Phone</a>
        </div>
        <div class="form-group">
            <h6 style="color:blue;">Email</h6>
            <input type="text" name="email" class="form-control"/>
            <a href="">Edit Email</a>
        </div>
        <div>
            <a href="{{ route('customerchangepassword') }}">Change Password</a>
        </div>
    </body>
@endsection
