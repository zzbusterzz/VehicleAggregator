@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body id="main_body"  style="height:1500px">
        @php 
            $categories = \App\ProductCategory::all();

            $brandsData = \App\Vehicle::all();

            $brandarr = array();
            
            $i = 0;

            $values = null;


            // https://www.w3schools.com/php/func_array_keys.asp
            // https://stackoverflow.com/questions/36029466/laravel-print-array-in-blade-php/36031118
            // https://stackoverflow.com/questions/1355072/array-push-with-key-value-pair
            foreach ($brandsData as $brand) {

                if($values == null)
                    $values = $brand->id;
                else
                    $values = $values .'/'. $brand->id;

                if ($brandarr != null && array_key_exists($brand->brandname, $brandarr)){
                    //array_push($a,"blue","yellow")
                    array_push($brandarr[$brand->brandname], $brand->model);
                }else{
                   // $brandarr = array($brand->brandname => array());
                   // array_push($brand->brandname, array());
                    $brandarr[$brand->brandname] = array();
                    array_push($brandarr[$brand->brandname], $brand->model);
                }
                $i++;
            }
            $brandkeys = array_keys($brandarr);    
        @endphp

        @section('navbarButtons')
        <li><a href="{{ route('vendordashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('vendorreadyorder') }}">Ready Order</a></li>
        <li><a href="{{ route('vendorcompleteorder') }}">Complete Order</a></li>
        <li class="active"><a href="{{ route('vendorinventory') }}">Parts Inventory</a></li> {{--To view the stock available and to add or remove stock--}}
        @endsection

        <div class="container" style="margin-top:50px">

            <form action="/addproduct" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="panel panel-default" style="margin-top:40px">
                    <div class="panel-heading"><h3>Add Part To Inventory</h3></div>
    
                    @if (session('info'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('infoprofile') }}
                            </div>
                        </div>
                    </div>
                    @elseif (session('error'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{ session('errorprofile') }}
                            </div>
                        </div>
                    </div>
                    @endif
    
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

                        {{-- Part Name --}}
                        <div class="form-group">
                            <h5 style="color:blue;">Part Name : </h5>
                            <input id="name" type="text" name="name" value= "" class="form-control"/>
                        </div>
    
                        {{-- Drop down part category --}}
                        <div class="form-group">
                            <h5 style="color:blue;">Part Category: </h5>                        
                            <select name="category" id="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Part description as text area --}}
                        <div class="form-group">
                            <h5 style="color:blue;">Part Description: </h5>
                            <textarea id="partdetails" class="form-control" rows="3" name="partdetails"></textarea>
                        </div>
    
                        {{-- Part Price --}}
                        <div class="form-group">
                            <h5 style="color:blue;">Price : </h5>
                            <input id="price" type="text" name="price" value = "" class="form-control"/>
                        </div>
    
                        {{-- Part Image --}}
                        <div class="form-group">
                            <h5 style="color:blue;">Image :</h5>                            
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
    
                        {{-- Brand --}}                       
                        <div class="custom-control custom-checkbox">
                            <h5 style="color:blue;">Select Brands :</h5>    
                            @foreach($brandkeys as $brands) 
                                    <input type="checkbox" class="custom-control-input" id="{{ $brands }}" onclick="updateFieldValue('{{$brands}}')"/>
                                    <label class="custom-control-label" for="{{ $brands }}">{{ $brands }}</label>
                            @endforeach
                        </div>


                        {{-- Models --}}
                        <div class="custom-control custom-checkbox">
                            <h5 style="color:blue;">Select Models :</h5>    

                            @foreach($brandsData as $brand)
                       
                            <input type="checkbox" class="custom-control-input" id="{{ $brand->id }}" name="model[]" onclick="updateInputFieldValue('{{$brand->id}}')" style="display:none"/>
                            <input id="brand{{ $brand->id }}" type="text" name="{{ $brand->id }}" class="form-control" style="display:none"/>
                            <label id="label{{ $brand->id }}" class="custom-control-label" for="{{ $brand->id }}" style="display:none">{{ $brand->model }}</label>
                        
                        
                            @endforeach
                        </div>

                        
                        <input id="brandvalues" type="text" name="brandvalues" class="form-control" value ="{{ $values }}" style="display:none"/>
                        <br>

                        <div class="form-group">
                            <input id="addtopart" type="submit" name="Add Part" value="Add To Inventory" class="btn btn-primary"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>

    <script type="text/javascript">
        function updateFieldValue(brandname){
            var tempdata = JSON.parse('<?php echo($brandsData); ?>');

            for(var i = 0; i < tempdata.length; i++){
                if( tempdata[i].brandname == brandname){
                    var checkBoxes = $("#"+brandname);
                    if(checkBoxes.prop("checked")){
                        $("#"+tempdata[i].id).show();
                        $("#label"+tempdata[i].id).show();
                    }
                    else{
                        
                        $("#"+tempdata[i].id).hide();
                        $("#label"+tempdata[i].id).hide();
                    }
                    
                }
            }
        }

        function updateInputFieldValue(id){
            var checkBoxes = $("#"+id);
            if(checkBoxes.prop("checked")){
                $("#brand"+id).val("true");
            }
            else{
                $("#brand"+id).val("false");
            }
        }
    </script>

@endsection
