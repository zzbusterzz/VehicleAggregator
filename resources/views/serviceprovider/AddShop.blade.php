@php( $services = \App\Service::all())


@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style type="text/css">
            .my-custom-scrollbar {
                position: relative;
                height: 300px;
                overflow: auto;
            }
            .table-wrapper-scroll-y {
                display: block;
            }
            .table td {
                text-align: center;
            }
            .table th {
                text-align: center;
            }
            .display-none {
                display: none;
            }
        </style>
    </head>

    <body id="main_body"  style="height:1500px">

        @section('navbarButtons')
        <li class="active"><a href="spdashboard">Ongoing Requests</a></li>
        {{-- Dashboard will show new bookings which user can set status --}}
        <li><a href="{{ route('pendingrequests') }}">Pending Requests</a></li>
        {{-- ongoingrequests --}}
        <li><a href="{{ route('completedrequests') }}">Completed Requests</a></li>
        {{-- completedrequests --}}
        <li><a href="{{ route('addshop') }}">Add Shop</a></li>
        @endsection

        <div style="margin-top:50px">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Add a shop.</b></div>
                <div class="panel-body">Add a new shop which can provide a service.</div>
              </div>

              <div style="margin-top:50px">
                <div class="panel panel-info">
                    <div class="panel-heading"><b>Enter Details Below</b></div>
                    <div class="panel-body">


                        @if(count($errors) > 0)
                             <div class="alert alert-danger">
                                <ul>
                                 @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    <form method="post" action="{{url('shop')}}">
                            {{csrf_field()}}

                            <label>Select a Service which the Shop provides. </label>

                            <div>
                                <select name="Service" id="Service">
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                    <option id="other" value="other">Other</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Shop No. </label>
                                <input type="text" name="shopno" class="form-control" placeholder="Shop No." maxlength = "6"/>
                            </div>
                            <div class="form-group">
                                <label>Shop Name</label>
                                <input type="text" name="shopname" class="form-control" placeholder="Shop Name" />
                            </div>
                            <div class="form-group">
                                <label>Shop Phone</label>
                                <input type="text" name="shopphone" class="form-control" placeholder="Shop Phone" maxlength = "10"/>
                            </div>
                            <div>
                                <h3><b>Location</b></h3>
                            </div>
                            <div class="form-group">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control" placeholder="Street" />
                            </div>
                            <div class="form-group">
                                <label>Locality</label>
                                <input type="text" name="locality" class="form-control" placeholder="Locality" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" placeholder="City" />
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" placeholder="State" />
                            </div>
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" name="pincode" class="form-control" placeholder="Pincode" maxlength = "6"/>
                            </div>
                            <br>
                            <div>
                                <input type="submit" name="submit" value="Add Shop" class="btn btn-primary"/>
                            </div>
                        </form>
                    </div>
                  </div>

        </div>




    </body>
    @endsection
