@php( $services = \App\Service::all())

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body id="main_body">
        <b>Dashboard</b>

        <div id="form_container">
            <form id="form_100455" class="appnitro" action="">
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
            <form id="formDes" class="formDes">
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
                </form>	
            </div>

            </form>
        </div>

       

        <div id="bookform_container" class="bookVehicle" style="display:none">
            <form id="form_100455" class="appnitro" method="post" action="">
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
                  <input id="element_1_1" name="element_1_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>HH</label>
                  </span>
                        <span>
                  <input id="element_1_2" name="element_1_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
                  <label>MM</label>
                  </span>
                        <span>
                  <input id="element_1_3" name="element_1_3" class="element text " size="2" type="text" maxlength="2" value=""/>
                  <label>SS</label>
                  </span>
                        <span>
                     <select class="element select" style="width:4em" id="element_1_4" name="element_1_4">
                        <option value="AM" >AM</option>
                        <option value="PM" >PM</option>
                     </select>
                     <label>AM/PM</label>
                  </span>
                    </li>
                    <li id="li_2">
                        <label class="description" for="element_2">Vehicle Reg No: </label>
                        <div>
                            <input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="" />
                        </div>
                    </li>
                    <li id="li_4">
                        <label class="description" for="element_4">Brand Name </label>
                        <div>
                            <select class="element select medium" id="element_4" name="element_4">
                                <option value="" selected="selected"></option>
                                <option value="1">First option</option>
                                <option value="2">Second option</option>
                                <option value="3">Third option</option>
                            </select>
                        </div>
                    </li>
                    <li id="li_5">
                        <label class="description" for="element_5">Brand Model </label>
                        <div>
                            <select class="element select medium" id="element_5" name="element_5">
                                <option value="" selected="selected"></option>
                                <option value="1">First option</option>
                                <option value="2">Second option</option>
                                <option value="3">Third option</option>
                            </select>
                        </div>
                    </li>
                    <li id="li_3">
                        <label class="description" for="element_3">Year of Mfg </label>
                        <div>
                            <input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="" />
                        </div>
                    </li>
                    <li class="buttons">
                        <input type="hidden" name="form_id" value="100455" />
                        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
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
        if(value != " " || value != "Select State"){
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

        if(city != " " || city != "Select Cityr"){
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
        var value = $(this).attr("id");
        var id = $(this).val();
        //'id', 'h_no', 'street', 'locality', 'city', 'state', 'pincode', 'shopphone', 'shopname'
        if(ServiceProviders != " " || ServiceProviders != "Pick a provider" && tempLocations.length > 0){
            $("#descp").show(); //Hide description form
            $("#bookform_container").show(); //Hide description form

            console.log(id);
            console.log(tempLocations[id][8]);
            $(shopName).val(tempLocations[id][8]);
            $(address_disp).val(tempLocations[id][1] + "," + tempLocations[id][2] +  ", " + tempLocations[id][3]);
            $(city_disp).val(tempLocations[id][4]);
            $(state_disp).val(tempLocations[id][5]);
            $(zip_code).val(tempLocations[id][6]);
        }

        if(value == "Pick a provider"){           
            $("#descp").hide(); //Hide description form
            $("#bookform_container").hide(); //Hide description form
        }
    });
        
</script>
    