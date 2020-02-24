@extends('master')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarServices</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.js" rel="stylesheet">
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
                    <input type="submit" name="submit" class="btn btn-primary"/>
                </div>

                </form>
        </div>
</div>
@endsection
