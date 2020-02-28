@php( $services = \App\Service::all())

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Document</title>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
        </style>
    </head>

    <body id="main_body">
        <b>Dashboard</b>

        <div id="form_container">
            <form id="form_100455" class="appnitro">
                <label>Choose the service which you require available in above location : </label>

                <div>
                    <select name="Service" id="Service">
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select name="state" id="state">
                        <option value="">Select State</option>
                    </select>
                </div>  
                
                <div class="form-group">
                    <select name="city" id="city" >
                        <option value="">Select City</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="ServiceProviders" id="ServiceProviders" >
                        <option value="">Pick a provider</option>
                    </select>
                </div>
                
               
            <div id="descp">
                <ul >
                    <li id="li_1" >
                        <label>Shop Detaillls </label>
            
                            <div>
                                <label >Shop Name</label>
                                <input id="shopName" name="shopName" class="element text large" value="" type="text" disabled>
                            </div>
                        
                            <div>
                                <label >Address</label>
                                <input id="address_disp" name="address_disp" class="element text large" value="" type="text" disabled>
                            </div>
                        
                            <div class="left">
                                <label >City</label>
                                <input id="city_disp" name="city_disp" class="element text medium" value="" type="text" disabled>
                            </div>
                            
                            <div class="right">
                                <label>State / Province / Region</label>
                                <input id="state_disp" name="state_disp" class="element text medium" value="" type="text" disabled>
                                
                            </div>

                            <div class="left">
                                <label>Postal / Zip Code</label>
                                <input id="zip_code" name="zip_code" class="element text medium" maxlength="15" value="" type="text" disabled>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>



        <div id="bookform_container" class="bookVehicle" style="display:none">
                <div class="form_description">
                    <h2>Appointment Selection</h2>
                    <p></p>
                </div>

                <ul>
                    <li id="li_0">
                        <label for="birthday">Appointment Date:</label>
                        <input type="date" id="aptDate" name="aptDate">
                    </li>
                    <li id="li_1">
                        <label class="description" for="element_1">Appointment Time </label>
                        <span>
                  <input id="HH" name="HH" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>HH</label>
                  </span>
                        <span>
                  <input id="MM" name="MM" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>MM</label>
                  </span>
                        <span>
                        <select class="element select" style="width:4em" id="AMPM" name="AMPM">
                        <option value="AM" >AM</option>
                        <option value="PM" >PM</option>
                     </select>
                     <label>AM/PM</label>
                  </span>
                    </li>
                    <li id="li_2">
                        <label class="description" for="vehicleno">Vehicle Reg No: </label>
                        <div>
                            <input id="vehicleno" name="vehicleno" class="element text medium" type="text" maxlength="255" value="" />
                        </div>
                    </li>
                    <li id="li_4">
                        <label class="description" for="brandname">Brand Name</label>
                        <div>
                            <select class="element select medium" id="brandname" name="brandname">
                                <option value="">Select Vehicle Brand</option>
                               
                            </select>
                        </div>
                    </li>
                    <li id="li_5">
                        <label class="description" for="brandmodel">Brand Model</label>
                        <div>
                            <select class="element select medium" id="brandmodel" name="brandmodel">
                                <option value="">Select Vehicle Model</option>
                            </select>
                        </div>
                    </li>
                    <li id="li_3">
                        <label class="description" for="yrofmfg">Year of Mfg </label>
                        <div>
                            <input id="yrofmfg" name="yrofmfg" class="element text medium" type="text" maxlength="255" value="" />
                        </div>
                    </li>
                    <li class="buttons">
                        <input id="submitBooking" class="Book Service" type="submit" name="submitBooking" value="Submit"/>
                    </li>
                </ul>
            </form>
        </div>

    </body>

</html>


<script type="text/javascript">
    var tempLocations = new Array();
    $("#descp").hide(); //Hide description form
    $("#bookform_container").hide(); //Hide description form

    $(document.body).on('change',"#Service",function (e) {
       
        $.ajax({
            type:"get",
            url:'/getStates',
            success:function(res)
            {
                if(res)
                {
                    var op = " ";
                    $("#state").empty();
                    $("#state").append('<option>Select State</option>');
                    for (var i = 0; i < res.length; i++){
                        op += '<option value="'+res[i].state+'">'+res[i].state+'</option>';
                    }
                    $("#state").append(op);
                }
            }
        });
    });

    $(document.body).on('change',"#state",function (e) {
        var value = $(this).val();
        if(value != " " && value != "Select State"){
            $.ajax({
                type:"get",
                url:'/getCities/'+ value,
                success:function(res)
                {       
                    if(res)
                    {
                        var op = " ";
                        $("#city").empty();
                        $("#city").append('<option>Select City</option>');
                        for (var i = 0; i < res.length; i++){
                            op += '<option value="'+res[i].city+'">'+res[i].city+'</option>';
                        }
                        $("#city").append(op);
                    }
                }
            });
        }

        if(value == "Select State"){           
            $("#city").empty();
            $("#city").append('<option>Select City</option>');

            $("#ServiceProviders").empty();
            $("#ServiceProviders").append('<option>Pick a provider</option>');
        }
    });

    $(document.body).on('change',"#city",function (e) {
        var state = $("#state").val();
        var city = $(this).val();

        if(city != " " && city != "Select Cityr"){
            $.ajax({
                type:"get",
                url:'/getLocations/'+ state + "/" + city,
                success:function(res)
                {       
                    if(res)
                    {
                        tempLocations.length = 0;
                        var op = " ";

                        $("#ServiceProviders").empty();
                        $("#ServiceProviders").append('<option>Pick a provider</option>');
                        for (var i = 0; i < res.length; i++){
                            op += '<option value="'+i+'">'+res[i].shopname + ", " + res[i].h_no + "," + res[i].street + 
                            ", " + res[i].locality +'</option>';

                            var value = [   res[i].id,   res[i].h_no,  res[i].street , res[i].locality, 
                                            res[i].city, res[i].state, res[i].pincode, res[i].shopphone,  res[i].shopname ];
                            tempLocations.push(value);
                        }
                        $("#ServiceProviders").append(op);
                    }
                }
            });
        }

        if(city == "Select City"){           
            $("#ServiceProviders").empty();
            $("#ServiceProviders").append('<option>Pick a provider</option>');
        }
    });

    $(document.body).on('change',"#ServiceProviders",function (e) {
        var value = $( "#ServiceProviders option:selected" ).text();
        var id = $(this).val();
        //'id', 'h_no', 'street', 'locality', 'city', 'state', 'pincode', 'shopphone', 'shopname'
    
      //  console.log(value.localeCompare("Pick a provider"));
        if(value != " " && value != "Pick a provider" && tempLocations.length > 0){
            $("#descp").show(); //Hide description form
            $("#bookform_container").show(); //Hide description form

          //  console.log(id);
          //  console.log(tempLocations[id][8]);
            $(shopName).val(tempLocations[id][8]);
            $(address_disp).val(tempLocations[id][1] + "," + tempLocations[id][2] +  ", " + tempLocations[id][3]);
            $(city_disp).val(tempLocations[id][4]);
            $(state_disp).val(tempLocations[id][5]);
            $(zip_code).val(tempLocations[id][6]);

            if($('#brandname option').length <= 1){
                UpdateBrand();
            }
        }

        if(value == "Pick a provider"){           
            $("#descp").hide(); //Hide description form
            $("#bookform_container").hide(); //Hide description form
        }
    });
    
    function UpdateBrand(){
       console.log("updating brand");

        $.ajax({
            type:"get",
            url:'/getBrandnames',
            success:function(res)
            {       
                if(res)
                {
                    var op = " ";

                    $("#brandname").empty();
                    $("#brandname").append('<option>Select Vehicle Brand</option>');
                    for (var i = 0; i < res.length; i++){
                        op += '<option value="'+ i +'">'+res[i].brandname+'</option>';
                    }
                    $("#brandname").append(op);
                }
            }
        }); 
       
    }

    $(document.body).on('change',"#brandname",function (e) {
        var brandName = $( "#brandname option:selected" ).text();;
        if(brandName != " " && brandName != "Select Vehicle Brand"){
            console.log("brand");
            $.ajax({
                type:"get",
                url:'/getBrandmodels/'+ brandName,
                success:function(res)
                {       
                    if(res)
                    {
                        var op = " ";

                        $("#brandmodel").empty();
                        $("#brandmodel").append('<option>Select Vehicle Model</option>');
                        for (var i = 0; i < res.length; i++){
                            op += '<option value="'+res[i].id+'">'+res[i].model+'</option>';
                        }
                        $("#brandmodel").append(op);
                    }
                }
            });

           
        }

        if(brandName == "Pick a provider"){           
            //Disable submit button
           /// $("#submitBooking").hide();            
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            //booking_id    X
        //service_id
        //vehiclebrand_id
        //location_id
        //customer_id       X
        //serviceprovider_idX
        //appointment_date
        //appointment_time
        //booking_date
        //booking_time
        //vehicleno
        //yearofmfc
        //status

    $("#submitBooking").click(function(e){
        e.preventDefault();
        console.log("cllicking button");

        var id = $('#ServiceProviders').val();
        console.log(tempLocations.length);

        var service_id          = $("#Service").val();
        var vehiclebrand_id     = $("#brandmodel").val();
        var location_id         = tempLocations[id][0];

        $date=$("#aptDate").val();
        var appointment_date    = $date;
        console.log( appointment_date);

        $ampm = $( "#AMPM option:selected" ).text();

        var appointment_time ;
        var hrs = $("#HH").val();
        hrs = parseInt(hrs) + 12 ;
        if($ampm == "PM")
            appointment_time    = hrs  + ":" + $("#MM").val() + ":00";

        var today = new Date();
        var booking_date        = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        console.log( booking_date);
        var booking_time        = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        console.log( booking_time);

        var vehicleno           = $("#vehicleno").val();
        var yearofmfc           = $("#yrofmfg").val();

        $.ajax({
            type:'POST',
            url:'/registerBooking',
            data:{  service_id:service_id, vehiclebrand_id:vehiclebrand_id, location_id:location_id, appointment_date:appointment_date,
                    appointment_time:appointment_time, booking_date:booking_date, booking_time:booking_time, vehicleno:vehicleno, yearofmfc:yearofmfc
            },

            success:function(data){
                alert(data.success);
            }
        });
    });
  
</script>
