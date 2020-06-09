@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body id="main_body"  style="height:1500px">

        @section('navbarButtons')
        <li class="active"><a href="#">Ongoing Requests</a></li>
        {{-- Dashboard will show ongoing bookings --}}
        <li><a href="#">Pending Requests</a></li>
        <li><a href="#">Completed Requests</a></li>
        <li><a href="#">Parts Inventory</a></li> {{--To view the stock available and to add or remove stock--}}
        @endsection

        <div class="container" style="margin-top:50px">
            <b>Dashboard</b>

    </body>



@endsection
