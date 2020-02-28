@extends('master')

@section('content')

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

<div class="row">
    <div class="col-md-12">
        <h3 aling = "center"> Register Here! <h3>
        <br/>
        @if(count($errors) > 0)

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
        <p>{{\Session::get('success')}}</p>
        </div>
        @endif
            <form method="post" action="{{url('customer')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <select id="usertype" name="usertype" class="form-control">
                        <option value="cust">Customer</option>
                        <option value="sp">Service Provider</option>
                        <option value="vendor">Parts Vendor</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="Enter First Name :" />
                </div>

                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name :" />
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username :" />
                    <input type="text" name="type"/>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password :" />
                </div>

                <div class="form-group">
                    <input type="password" name="confirmpass" class="form-control" placeholder="Re-Enter Password :" />
                </div>

                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number :" maxlength = "10" />
                </div>

                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email :" />
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="submit" value="Register" class="btn btn-primary"/>
                </div>

                </form>
        </div>
</div>
@endsection
