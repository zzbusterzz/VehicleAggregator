@php( $services = \App\Service::all())

@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body id="main_body">

        @section('navbarButtons')
        {{-- https://stackoverflow.com/questions/38709886/call-route-from-button-click-laravel --}}
        <li class="active"><a href="{{ route('customerdashboard') }}">Dashboard</a></li>{{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('customerbookservice') }}">Book a Service</a></li>
        <li><a href="{{ route('customershowbookings') }}">Completed Requests</a></li>
        @endsection

        <div class="container" style="margin-top:50px">
            <b>Dashboard</b>
        </div>
    </body>
@endsection
