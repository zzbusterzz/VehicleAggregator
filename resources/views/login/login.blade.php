@extends('master')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

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
    <body>
        <div class="form-group">
            <h3 align="center">Log IN</h3>
        </div>

        <form action="/loginme" method="POST">
            {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <select id="usertype" name="usertype" class="form-control">
                <option value="cus_">Customer</option>
                <option value="sp_">Service Provider</option>
                <option value="ven_">Parts Vendor</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" name="username" required="" class="form-control" placeholder="Enter Username :" />
        </div>
        <div class="form-group">
            <input type="password" name="password" required="" class="form-control" placeholder="Enter Password :" />
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Log IN" class="btn btn-primary"/>
        </div>
        <div class="form-group">
        <a href="{{ route('register') }}"><h5>Need a new account? Register Here!</h5></a>
        </div>

        </form>
    </body>
</html>

@endsection
