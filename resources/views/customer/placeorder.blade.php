@php( $services = \App\Service::all())

@extends('master')

@section('content')

    <head>
        @extends('layout.header');
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            .filterDiv {
              float: left;
              background-color: #2196F3;
              color: #ffffff;
              width: 100px;
              line-height: 100px;
              text-align: center;
              margin: 2px;
              display: none;
            }

            .show {
              display: block;
            }

            .container {
              margin-top: 20px;
              overflow: hidden;
            }

            /* Style the buttons */
            .btn {
              border: none;
              outline: none;
              padding: 12px 16px;
              background-color: #f1f1f1;
              cursor: pointer;
            }

            .btn:hover {
              background-color: #ddd;
            }

            .btn.active {
              background-color: #666;
              color: white;
            }
            .slidecontainer {
                width: 100%;
            }

            .slider {
                -webkit-appearance: none;
                width: 100%;
                height: 25px;
                background: #d3d3d3;
                outline: none;
                opacity: 0.7;
                -webkit-transition: .2s;
                transition: opacity .2s;
            }

            .slider:hover {
                opacity: 1;
            }

            .slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 25px;
                height: 25px;
                background: #4CAF50;
                cursor: pointer;
            }

            .slider::-moz-range-thumb {
                width: 25px;
                height: 25px;
                background: #4CAF50;
                cursor: pointer;
            }
            </style>
    </head>

    <body id="main_body" >

        @section('navbarButtons')
        {{-- https://stackoverflow.com/questions/38709886/call-route-from-button-click-laravel --}}
        <li><a href="{{ route('customerdashboard') }}">Dashboard</a></li>{{-- Dashboard will show ongoing bookings --}}
        <li><a href="{{ route('customerbookservice') }}">Book a Service</a></li>
        <li><a href="{{ route('customershowbookings') }}">Completed Requests</a></li>
        <li class="active"><a href="{{ route('customerplaceorder') }}">Order Part</a></li>
        @endsection

        <div class="container" style="margin-top:50px"> {{--https://medium.com/justlaravel/search-functionality-in-laravel-a2527282150b--}}
            <label>Search Parts</label>
            <form action="/search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Search"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>

            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Filters</button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Filters</h6>
                </div>
                <div class="modal-body">

            <div id="myBtnContainer"> {{-- https://www.w3schools.com/howto/howto_js_filter_elements.asp --}}
            <button class="btn" onclick="filterSelection('Brand')"> Brand</button>
            <button class="btn" onclick="filterSelection('Model')"> Model</button>
            </div>

            <div class="container">

            <div class="filterDiv Brand"><input type="checkbox" id="Brand1" name="Brand1" value="BMW">BMW</div>
            <div class="filterDiv Model"><input type="checkbox" id="Model1" name="Model1" value="320d">320d</div>
            <div class="filterDiv Brand"><input type="checkbox" id="Brand2" name="Brand2" value="Volvo">Volvo</div>
            <div class="filterDiv Brand"><input type="checkbox" id="Brand3" name="Brand3" value="TATA">TATA</div>
            <div class="filterDiv Brand "><input type="checkbox" id="Brand4" name="Brand4" value="Mustang">Mustang</div>
            <div class="filterDiv Brand"><input type="checkbox" id="Brand5" name="Brand5" value="Nissan">Nissan</div>
            <div class="filterDiv Model"><input type="checkbox" id="Model2" name="Model2" value="Micra">Micra</div>
            <div class="filterDiv Model"><input type="checkbox" id="Model3" name="Model3" value="WagonR">WagonR</div>
            <div class="filterDiv Model"><input type="checkbox" id="Model4" name="Model4" value="Swift">Swift</div>
            <div class="filterDiv Brand"><input type="checkbox" id="Brand6" name="Brand6" value="MarutiSuzuki">MarutiSuzuki</div>
            </div>
                </div>
                <p>Choose your price range.</p>

            <div class="slidecontainer">
                <input type="range" min="50" max="5000" value="50" class="slider" id="myRange">
                <p>Value: <span id="demo"></span></p>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>

        <div class="container" style="margin-top:10px">
        </div>

        </div>

    </body>

    <script>
        filterSelection("all")
        function filterSelection(c) {
          var x, i;
          x = document.getElementsByClassName("filterDiv");
          if (c == "all") c = "";
          for (i = 0; i < x.length; i++) {
            RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
          }
        }

        function AddClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
          }
        }

        function RemoveClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
              arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
          }
          element.className = arr1.join(" ");
        }

        // Add active class to the current button (highlight it)
        var btnContainer = document.getElementById("myBtnContainer");
        var btns = btnContainer.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }

        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
        output.innerHTML = this.value;
        }

        </script>

@endsection
