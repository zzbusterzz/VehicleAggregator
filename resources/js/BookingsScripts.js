    var tempLocations = new Array();
    $("#descp").hide(); //Hide description form
    $("#bookform_container").hide(); //Hide description form

    $(document.body).on('change',"#Service",function (e) {
        var service_id = $("#Service").val();
        $.ajax({
            type:"get",
            url:'/getStates/' + service_id,
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
        var service_id = $("#Service").val();
        var state = $(this).val();
        if(state != " " && state != "Select State"){
            $.ajax({
                type:"get",
                url:'/getCities/'+ service_id + "/" + state,
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
        var service_id = $("#Service").val();
        var state = $("#state").val();
        var city = $(this).val();

        if(city != " " && city != "Select Cityr"){
            $.ajax({
                type:"get",
                url:'/getLocations/'+ service_id + "/" + state + "/" + city,
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