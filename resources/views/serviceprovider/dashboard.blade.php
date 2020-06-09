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


        @php
            $type = Session::get('usertype');

            $data = \App\ServiceProvider::select('firstname', 'lastname','phone','email')
                            ->where('id', Session::get('user_id'))
                            ->get();
        @endphp

        @section('navbarButtons')
        <li class="active"><a href="spdashboard">Ongoing Requests</a></li>
        {{-- Dashboard will show new bookings which user can set status --}}
        <li><a href="{{ route('ongoingrequests') }}">Pending Requests</a></li>
        {{-- ongoingrequests --}}
        <li><a href="{{ route('completedrequests') }}">Completed Requests</a></li>
        {{-- completedrequests --}}
        @endsection

        <div class="container" style="margin-top:50px">
            <h4><b>Welcome to WheelWorks <i>{{ Session::get('user_name') }}</i>!<b></h4>
            <b>Dashboard</b>

            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="margin-top:10px" id="dbcontainer">

                <input type="text" name="username" class="form-control" value= {{ Session::get('user_name') }} disabled/>

                <input id="fname" type="text" name="fname" value = {{ $data[0]->firstname }} class="form-control"/>
                <input id="fname" type="text" name="fname" value = {{ $data[1]->lastname }} class="form-control"/>
                <input id="fname" type="text" name="fname" value = {{ $data[2]->phone }} class="form-control"/>
                <input id="fname" type="text" name="fname" value = {{ $data[3]->email }} class="form-control"/>

            </div>


        </div>

    </body>



    @endsection
