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

            <form method="post" action="{{url('customer')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <h6 style="color:blue;">Select User Type</h6>
                    <select id="usertype" name="usertype" class="form-control">
                        <option value="" disabled selected>Select User Type</option>
                        <option value="cust">Customer</option>
                        <option value="sp">Service Provider</option>
                        <option value="vendor">Parts Vendor</option>
                    </select>
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Enter First Name : </h6>
                    <input type="text" name="firstname" class="form-control" placeholder="First Name :" />
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Enter Last Name : </h6>
                    <input type="text" name="lastname" class="form-control" placeholder="Enter Last Name :" />
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username :" /> <input type="text" name="type" class="form-control" placeholder="_cus"/>
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Enter Password : </h6>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password :" />
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Re-Enter Password </h6>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Enter Password :" />
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Enter Phone Number : </h6>
                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number :" maxlength = "10" />
                </div>

                <div class="form-group">
                    <h6 style="color:blue;">Enter Email : </h6>
                    <input type="text" name="email" class="form-control" placeholder="Enter your email :" />
                </div>
                <div>
                    <h6 style="color:blue;">Upload Profile Picture</h6>
                    <h6> <input type="file" name="vdp" id="vdp"></h6>
                </div>
                <div>
                    <h6 style="color:blue;">Select document to upload :</h6>
                    <h6 style="color:blue;">Shop License / Aadhar Card / ID Proof</h6>
                    <h6><input type="file" name="fileToUpload" id="fileToUpload"></h6>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="submit" value="Register" class="btn btn-primary"/>
                </div>

                </form>
                <div class="form-group">
                    <a href="{{ route('login') }}"><input type="submit" name="submit" value="Login" class="btn btn-primary"/></a>
                </div>
        </div>
</div>
@endsection
