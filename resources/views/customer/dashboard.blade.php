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
        <li class="active"><a href="{{ route('customerdashboard') }}">Dashboard</a></li>{{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('customerbookservice') }}">Book a Service</a></li>
        <li><a href="{{ route('customershowbookings') }}">Completed Requests</a></li>
        @endsection

        <div style="margin-top:50px">
        <h4><b>Welcome to WheelWorks <i>@username</i>!<b></h4>
        <p>This is your dashboard.<br>Here you can see your onoing booking.<br>Click the button below to check your bookings.</p>
        </div>
<br>
        <input id="show" type="submit" name="submit" value="SHOW ONGOING REQUESTS" class="btn btn-primary"/>

        <div class="table-wrapper-scroll-y my-custom-scrollbar display-none" style="margin-top:10px" id="placeholder">

            <input id="hide" type="submit" name="submit" value="HIDE ONGOING REQUESTS" class="btn btn-primary"/>

            {{-- <table class="table  table-wrapper-scroll-y my-custom-scrollbar table-hover"> --}}
                <table class="table table-striped mb-0 table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service Provider ID</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- https://stackoverflow.com/questions/49768361/laravel-increment-id --}}
                    @php
                        $i = 0;
                    @endphp

                    @php( $data = \App\Requests::all())

                    @foreach($data as $val)
                    <?php $i++ ?>
                    <tr class='clickable-row'>
                        {{-- Get service id for displalying bookings
                            get vehiclebrand id for displaying car type
                            get location id for displlaying loc
                            --}}
                        <th scope="row">{{ $i}}</th>
                        <td>{{ $val->serviceprovider_id }}</td>
                        <td>{{ $val->status }}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        Modal body..
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </body>


    <script type="text/javascript">
        $(".clickable-row").click(function() {
            $("#myModal").modal();
        });

        $("#hide").click(function(){
        $("[id^='placeholder']").hide();
        });

        $("#show").click(function(){
        //$("[id^='placeholder']").hide();
        $("#placeholder").show();
        }); //https://stackoverflow.com/questions/31826469/how-to-display-a-div-only-when-a-button-is-clicked
    </script>
@endsection
