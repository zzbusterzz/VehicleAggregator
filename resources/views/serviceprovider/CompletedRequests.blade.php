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
        <li><a href="spdashboard">Dashboard</a></li>
        {{-- Dashboard will show new bookings which user can set status --}}
        <li><a href="{{ route('ongoingrequests') }}">Ongoing Requests</a></li>
        {{-- ongoingrequests --}}
        <li class="active"><a href="{{ route('completedrequests') }}">Completed Requests</a></li>
        {{-- completedrequests --}}
        @endsection

        <div class="container" style="margin-top:50px">
            <b>COMPLETED</b>

    </body>



@endsection
