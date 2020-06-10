@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body id="main_body"  style="height:1500px">
        @php 
            $categories = \App\ProductCategory::all();
        
        @endphp

        @section('navbarButtons')
        <li class="active"><a href="{{ route('vendordashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('vendorreadyorder') }}">Ready Order</a></li>
        <li><a href="{{ route('vendorcompleteorder') }}">Complete Order</a></li>
        <li><a href="{{ route('vendorinventory') }}">Parts Inventory</a></li> {{--To view the stock available and to add or remove stock--}}
        @endsection

        <div class="container" style="margin-top:50px">
            <b>Inventory</b>


            <form action="/updateprofile" method="POST">
                {{csrf_field()}}
                <div class="panel panel-default" style="margin-top:40px">
                    <div class="panel-heading"><h4>Profile</h4></div>
    
                    @if (session('info'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('infoprofile') }}
                            </div>
                        </div>
                    </div>
                    @elseif (session('error'))
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
                        {{-- Part Name --}}
                        <div class="form-group">
                            <h6 style="color:blue;">Part Name : </h6>
                            <input id="name" type="text" name="name" value= "" class="form-control"/>
                        </div>
    
                        {{-- Drop down part category --}}
                        <div>                            
                            <select name="Service" id="Service">
                                @foreach($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Part description as text area --}}
                        <div class="form-group">
                            <h6 style="color:blue;">Part Description: </h6>
                            <input id="fname" type="text" name="fname" value = "" class="form-control"/>
                        </div>
    
                        {{-- Part Price --}}
                        <div class="form-group">
                            <h6 style="color:blue;">Last Name : </h6>
                            <input id="lname" type="text" name="lname" value = "" class="form-control"/>
                        </div>
    
                        {{-- Part Image --}}
                        <div class="form-group">
                            <h6 style="color:blue;">Phone</h6>
                            <input id="phone" type="text" name="phone" value = "" class="form-control"/>
                        </div>
    
                        {{-- Brand --}}
                        <div class="form-group">
                            <h6 style="color:blue;">Email</h6>
                            <input id="email" type="text" name="email" value = "" class="form-control"/>
                        </div>
    
                        <div class="form-group">
                            <input id="updprof" type="submit" name="UpdateProfile" value="Update Profile" class="btn btn-primary"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>



@endsection
