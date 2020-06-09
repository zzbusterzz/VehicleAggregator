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

    <body id="main_body">

        @section('navbarButtons')
        {{-- https://stackoverflow.com/questions/38709886/call-route-from-button-click-laravel --}}
        <li class="active"><a href="{{ route('AdminDashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('UserData') }}">Manage Users</a></li>
        <li><a href="{{ route('Confirmation') }}">Confirmation</a></li>
        @endsection

        <div style="margin-top:50px">
        @include('logo')
        </div>



    </body>

@endsection
