@php( $users = \App\Customer::all())
@php( $sps = \App\ServiceProvider::all())
@php( $vens = \App\Vendor::all())

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
            <div class="panel panel-info">
                <div class="panel-heading"><h1>Customers</h1></div>
                    <div class="panel-body">
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Operation</th>
                                    </tr>
                                </thead>
                                @foreach ($users as $user)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->firstname }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                    <td><a href = 'delete/{{ $user->id }}'><input type="submit" name="submit" value="Remove Customer" class="btn btn-primary"/></a></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading"><h1>Service Providers</h1></div>
                        <div class="panel-body">
                            <div>
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Operation</th>
                                        </tr>
                                    </thead>
                                    @foreach ($sps as $sp)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ $sp->id }}</th>
                                            <td>{{ $sp->username }}</td>
                                            <td>{{ $sp->firstname }}</td>
                                            <td>{{ $sp->lastname }}</td>
                                            <td>{{ $sp->phone }}</td>
                                            <td>{{ $sp->email }}</td>
                                            <td><a href = 'deletesp/{{ $sp->id }}'><input type="submit" name="submit" value="Remove Service Provider" class="btn btn-primary"/></a></td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <div class="panel-heading"><h1>Vendors</h1></div>
                            <div class="panel-body">
                                <div>
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Operation</th>
                                            </tr>
                                        </thead>
                                        @foreach ($vens as $ven)
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ $ven->id }}</th>
                                                <td>{{ $ven->username }}</td>
                                                <td>{{ $ven->firstname }}</td>
                                                <td>{{ $ven->lastname }}</td>
                                                <td>{{ $ven->phone }}</td>
                                                <td>{{ $ven->email }}</td>
                                                <td><a href = 'deleteven/{{ $sp->id }}'><input type="submit" name="submit" value="Remove Vendor" class="btn btn-primary"/></a></td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

    </body>

@endsection
