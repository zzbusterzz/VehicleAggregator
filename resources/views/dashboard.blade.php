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

                <label class="description" for="element_2">Choose the service which you require available in above location : </label>
                <div>
                    <select name="Service" id="Service" class="form-control input-lg dynamic" data-dependent="state">
                        @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
                            {{-- @foreach($states as $state)
                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                            @endforeach --}}
                            <option value="">Select State</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <select name="city" id="city" class="form-control input-lg">
                            <option value="">Select City</option>
                        </select>
                    </div>

                </div>



            </form>
        </div>



    </body>

</html>


<script type="text/javascript">
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
        console.log(value);
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
    });

</script>
