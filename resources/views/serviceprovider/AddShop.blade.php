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

    {{-- https://www.webslesson.info/2019/04/how-to-join-multiple-table-in-laravel-58.html --}}
    {{-- https://www.youtube.com/watch?v=4wJkDwKtZXw --}}   
    <body id="main_body"  style="height:1500px">

        @section('navbarButtons')
        <li><a href="spdashboard">Ongoing Requests</a></li>
        {{-- Dashboard will show new bookings which user can set status --}}
        <li><a href="{{ route('pendingrequests') }}">Pending Requests</a></li>
        {{-- ongoingrequests --}}
        <li><a href="{{ route('completedrequests') }}">Completed Requests</a></li>
        {{-- completedrequests --}}
        <li class="active"><a href="{{ route('getshoplocations', Session::get('user_id')) }}">Add Shop</a></li>
        @endsection

        <div style="margin-top:50px">
            <div class="panel panel-info">
                <div class="panel-heading"><b>Add a shop.</b></div>
                    <div class="panel-body">

                        @php
                            $type = Session::get('usertype');
                        @endphp
                        

                        <table class="table table-striped mb-0 table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Shop Name</th>
                                <th scope="col">Address</th>
                              </tr>
                            </thead>
                            <tbody>
                                

                                @php
                                    $i = 0;
                                @endphp
                                @foreach($data as $val)
                                {{-- https://stackoverflow.com/questions/49768361/laravel-increment-id --}}
                                <?php $i++ ?>
                                <tr class='clickable-row' name ={{$val->location_id}}>
                                    {{-- Get service id for displalying bookings
                                        get vehiclebrand id for displaying car type
                                        get location id for displlaying loc
                                        --}}
                                    <th scope="row">{{ $i}}</th>
                                    <td>
                                        <?php
                                        $v1 = $val->shopname;
                                        ?>
            
                                        {{
                                            $v1
                                        }}
                                    </td>
                                    <td> {{ $val->h_no }}{{ $val->street }} {{ $val->locality }} {{$val->city }} {{$val->state }}</td>
                                    {{-- https://stackoverflow.com/questions/37460917/how-to-pass-value-on-onclick-function-in-laravel --}}
                                    <td><button class="btn btn-primary" onclick="setupEdit( '{{$i}}' );">Edit Details</button></td>
                                </tr>
            
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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

                        @if (session('info'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('infopwd') }}
                                </div>
                            </div>
                        </div>
                        @elseif (session('error'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('errorpwd') }}
                                </div>
                            </div>
                        </div>
                        @endif


                    {{-- https://laracasts.com/discuss/channels/laravel/how-do-i-handle-multiple-submit-buttons-in-a-single-form-with-laravel?page=1 --}}
                    <form method="post" action="{{url('updatedelShop')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Shop No. </label>
                                <input id="shopno" type="text" name="shopno" class="form-control" placeholder="Shop No." maxlength = "6"/>
                            </div>
                            <div class="form-group">
                                <label>Shop Name</label>
                                <input id="shopname" type="text" name="shopname" class="form-control" placeholder="Shop Name" />
                            </div>
                            <div class="form-group">
                                <label>Shop Phone</label>
                                <input id="shopphone" type="text" name="shopphone" class="form-control" placeholder="Shop Phone" maxlength = "10"/>
                            </div>
                            <div>
                                <h3><b>Location</b></h3>
                            </div>
                            <div class="form-group">
                                <label>Street</label>
                                <input id="street" type="text" name="street" class="form-control" placeholder="Street" />
                            </div>
                            <div class="form-group">
                                <label>Locality</label>
                                <input id="locality" type="text" name="locality" class="form-control" placeholder="Locality" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input id="city" type="text" name="city" class="form-control" placeholder="City" />
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input id="state" type="text" name="state" class="form-control" placeholder="State" />
                            </div>
                            <div class="form-group">
                                <label>Pincode</label>
                                <input id="pincode" type="text" name="pincode" class="form-control" placeholder="Pincode" maxlength = "6"/>
                            </div>
                            <br>

                            <label>Select a Service which the Shop provides. </label>

                            @php
                                $services = \App\Service::all();

                                $values = null;

                                foreach ($services as $service) {
                                    if($values == null)
                                        $values = $service->id;
                                    else
                                        $values = $values .'/'. $service->id;
                                }
                            @endphp

                         

                            <div>
                                {{-- <select name="Service" id="Service">
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                    <option id="other" value="other">Other</option>
                                </select> --}}
                                
                                    @php
                                        $i = 0;
                                    @endphp
                                   

                                @foreach($services as $service)                                
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{ $service->id }}" name="service[]" onclick="updateFieldValue('{{$service->id}}')"/>
                                        <input id="servid{{ $service->id }}" type="text" name="{{ $service->id }}" class="form-control" style="display:none"/>
                                        <label class="custom-control-label" for="{{ $service->id }}">{{ $service->name }}</label>
                                    </div>
                                    
                                    <?php $i++ ?>
                                @endforeach
                            </div>
                                <input id="locid" type="text" name="locid" class="form-control" value ="" style="display:none"/> 
                                <input id="servicevalues" type="text" name="servicevalues" class="form-control" value ="{{ $values }}" style="display:none"/>
                            <br>

                            <div>
                                <input id="submitDet"           type="submit" name="action"           value="Add Shop"    class="btn btn-primary"/>

                                <input id="clearform"           value="Clear"       class="btn btn-primary"     onclick = "clearFields();" style="display:none"/>
                                <input id="deleteshopdetails"   type="submit" name="action"  value="Delete"      class="btn btn-primary"    style="display:none"/>
                            </div>
                        </form>
                    </div>
                  </div>

        </div>
    </body>

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function setupEdit(id)
    {
        var tempdata = JSON.parse('<?php echo($data); ?>');

        var locationid = tempdata[id-1].location_id;

        $("#locid").val(locationid);

        $("#shopno").val(tempdata[id-1].h_no);
        $("#shopname").val(tempdata[id-1].shopname);
        $("#shopphone").val(tempdata[id-1].shopphone);
        $("#street").val(tempdata[id-1].street);
        $("#locality").val(tempdata[id-1].locality);
        $("#city").val(tempdata[id-1].city);
        $("#state").val(tempdata[id-1].state);
        $("#pincode").val(tempdata[id-1].pincode);

        
        $.ajax({
                type:"get",
                url:'/getservicesforlocation/'+ locationid,
                success:function(res)
                {
                    if(res)
                    {
                        var services = JSON.parse('<?php echo($services); ?>');
                        for(var i = 0; i < res.length; i++){
                            for(var j = 0; j < services.length; j++){
                                if(res[i].service_id == services[j].id){
                                    var checkBoxes = $("#"+res[i].service_id);
                                    checkBoxes.prop("checked", true);
                                    updateFieldValue(res[i].service_id);
                                }
                            }
                        }
                    }
                }
            });


        // id="shopname"
        // id="shopphone" 
        // id="street"
        // id="locality"
        // id="city" 
        // id="state"  
        // id="pincode"

        $("#submitDet").val("Update");
        $("#clearform").show();
        $("#deleteshopdetails").show();
    }

    function clearFields()
    {
        var services = JSON.parse('<?php echo($services); ?>');
        for(var i = 0; i < services.length; i++){
            var checkBoxes = $("#"+services[i].id);
            checkBoxes.prop("checked", false);
            updateFieldValue(services[i].id);
        }

        $("#locid").val();
        $("#shopno").val("");
        $("#shopname").val("");
        $("#shopphone").val("");
        $("#street").val("");
        $("#locality").val("");
        $("#city").val("");
        $("#state").val("");
        $("#pincode").val("");
        $("#locationidStore").val("");

        $("#submitDet").val("Add Shop");

        $("#clearform").hide();
        $("#deleteshopdetails").hide();
    }

    function updateFieldValue(service_id){
        var checkBoxes = $("#"+service_id);
        if(checkBoxes.prop("checked")){
            $("#servid"+service_id).val("true");
        }
        else{
            $("#servid"+service_id).val("false");
        }
    }
    </script>
    @endsection