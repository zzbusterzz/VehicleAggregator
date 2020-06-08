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
        <li class="active"><a href="{{ route('spdashboard') }}">Ongoing Requests</a></li>
        {{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('PendingRequests') }}">Pending Requests</a></li>
        <li><a href="{{ route('CompletedRequests') }}">Completed Requests</a></li>
        @endsection

        <div class="container" style="margin-top:50px">
            <b>COMPLETED</b>

    </body>



@endsection
