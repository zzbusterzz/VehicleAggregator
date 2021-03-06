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
            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #222222;
            color: white;
            text-align: center;
        }

        </style>
    </head>

    <body id="main_body" >

        <div class="footer">
            <p>WheelWorks 2019-2020 ©<p>
                <p>Making Vehicles Better For You since 2019!<p>
          </div>

        @section('navbarButtons')
        {{-- https://stackoverflow.com/questions/38709886/call-route-from-button-click-laravel --}}
        <li><a href="{{ route('customerdashboard') }}">Dashboard</a></li>{{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('customerbookservice') }}">Book a Service</a></li>
        <li class="active"><a href="{{ route('customershowbookings') }}">Completed Requests</a></li>
        <li><a href="{{ route('customerplaceorder') }}">Order Part</a></li>
        @endsection

        <div style="margin-top:50px">
            </div>
    <br>
            <input id="show" type="submit" name="submit" value="SHOW COMPLETED REQUESTS" class="btn btn-primary"/>

            <div class="table-wrapper-scroll-y my-custom-scrollbar display-none" style="margin-top:10px" id="dbcontainer">

                <input id="hide" type="submit" name="submit" value="HIDE COMPLETED REQUESTS" class="btn btn-primary"/>
                @php
                    $i = 0;

                    $data = \App\Requests::where('customer_id', Session::get('user_id'))
                            ->where('status', 'Complete')
                            ->get();

                    $services = App\Service::All();
                @endphp
                {{-- <table class="table  table-wrapper-scroll-y my-custom-scrollbar table-hover"> --}}
                    <table class="table table-striped mb-0 table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service Provider ID</th>
                        <th scope="col">Appointment Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                        {{-- https://stackoverflow.com/questions/49768361/laravel-increment-id --}}
                        <?php $i++ ?>
                        <tr class='clickable-row' name ={{$val->booking_id}}>
                            {{-- Get service id for displalying bookings
                                get vehiclebrand id for displaying car type
                                get location id for displlaying loc
                                --}}
                            <th scope="row">{{ $i}}</th>
                            <td>
                                <?php
                                $v1 = $val->service_id;


                                ?>

                                {{
                                    $v1
                                }}
                            </td>
                            <td>{{ $val->appointment_date }} {{$val->appointment_time }}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade right" id="modalDataDisp" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                        <h5 class="col-12 modal-title text-center" id="exampleModalPreviewLabel"><b>Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="modal-body">
                            <div>
                                <label ><b>Booking ID :</label>
                                <br>
                                <input id="bookingID" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Service Type :</label>
                                <br>
                                <input id="sType" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                        <hr>
                        <h5><b>Vehicle Details</h5>
                            <div>
                                <label ><b>Vehicle No :</label>
                                <br>
                                <input id="vehicleNo" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Year of Mfg :</label>
                                <br>
                                <input id="ymf" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Vehicle Brand :</label>
                                <br>
                                <input id="vBrand" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Vehicle Model :</label>
                                <br>
                                <input id="vModel" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                        <hr>
                        <h5><b>Shop Details</h5>
                            <div>
                                <label ><b>Shop Name :</label>
                                <br>
                                <input id="sProvider" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Location :</label>
                                <br>
                                <textarea id = "location"
                                    rows = "3"
                                     disabled> </textarea>
                                {{-- <input id="location" name="0000" class="element text large" value="" type="text" disabled> --}}
                            </div>

                        <hr>
                            <h5><b>Appointment Details</h5>
                            <div>
                                <label ><b>Date And Time:</label>
                                <br>
                                <input id="dandt" name="0000" class="element text large" value="" type="text" disabled>
                            </div>

                            <div>
                                <label ><b>Status:</label>
                                <br>
                                <input id="bookStatus" name="0000" class="element text large" value="" type="text" disabled>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Modal -->


            </div>

        </body>


        <script type="text/javascript">
            $(".clickable-row").click(function() {

                var currentRow=$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
                var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD

                var bookingID = currentRow.attr('name');

                var data=col1+"\n"+col2+"\n"+bookingID;

                var tempdata = JSON.parse('<?php echo($data); ?>');
                var servData =  JSON.parse('<?php echo($services); ?>');

                //Stores currently selected table values
                var service_id, vehiclebrand_id, location_id, serviceprovider_id, appointment_date, appointment_time, vehicleno, yearofmfc, status;

                //Fetch all these elements from queries which are
                //vehicle brand, vehicle model, service provider name
                //location and service type
                var vBrand, vModel, sProvider, location, sType;

                var temp;

                for (var i = 0; i < tempdata.length; i++){
                    if( tempdata[i].booking_id == bookingID){
                        temp = tempdata[i];

                        break;
                    }
                }

                $(".modal-body #bookingID").val( bookingID );
                $(".modal-body #vehicleNo").val(temp.vehicleno );
                $(".modal-body #ymf").val( temp.yearofmfc);
                $(".modal-body #dandt").val( temp.appointment_date + " " + temp.appointment_time);
                $(".modal-body #bookStatus").val( temp.status);

                //  alert(servData[0]);;

                $(".modal-body #sType").val(servData[0].name);

                $(".modal-body #vBrand").val('');
                $(".modal-body #vModel").val('');
                $(".modal-body #location").val('');
                $(".modal-body #sProvider").val('' );



                $.ajax({
                    type:"get",
                    url:'/getBrandmodelsAndsub/'+ temp.vehiclebrand_id,
                    success:function(res)
                    {
                        if(res)
                        {
                            $(".modal-body #vBrand").val(res[0].brandname );
                            $(".modal-body #vModel").val(res[0].model );
                        }
                    }
                });

                $.ajax({
                    type:"get",
                    url:'/getLocationOnID/'+ temp.location_id,
                    success:function(res)
                    {
                        if(res)
                        {
                            $(".modal-body #location").val(res[0].h_no + "," + res[0].street   + "," +res[0].locality + "," +res[0].city + "," +res[0].state + "," + res[0].pincode);
                            $(".modal-body #sProvider").val(res[0].shopname );
                        }
                    }
                });

                $("#modalDataDisp").modal();
            });

            $("#hide").click(function(){
                $("[id^='dbcontainer']").hide();
            });

            $("#show").click(function(){
                $("#dbcontainer").show();
            }); //https://stackoverflow.com/questions/31826469/how-to-display-a-div-only-when-a-button-is-clicked
        </script>
    @endsection
