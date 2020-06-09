<head>
    <title>WheelWorks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
     .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }

      /* Change the color of links on hover */
      .topnav a:hover {
        background-color: #ddd;
        color: black;
      }

      /* Add a color to the active/current link */
      .topnav a.active {
        background-color: #4CAF50;
        color: white;
      }

      /* Right-aligned section inside the top navigation */
      .topnav-right {
        float: right;
      }

      .topnav-right>li>a.profile-image {
          padding-top: 10px;
          padding-bottom: 10px;
      }

      .topnav-right>li>ul {
          margin-top: 33px;
      }

      .topnav-right>li>ul>li {
        text-align: center;
      }
    </style>
</head>

<body>
  {{-- https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_navbar_fixed&stacked=h navbar used from--}}
  {{-- https://www.w3schools.com/howto/howto_css_topnav_right.asp --}}
    <nav class="navbar navbar-inverse navbar-fixed-top topnav">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"> 🎡 WheelWorks</a>
          </div>
          <ul class="nav navbar-nav">
            @section('navbarButtons')
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            @show
          </ul>

          <div class="topnav-right">            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="http://placehold.it/24x24" class="profile-image img-circle"> {{ Session::get('user_name') }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu" >
                  <li><a href="{{ route('customerprofile') }}"><i class="fa fa-cog"></i> Profile</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Sign-out</a></li>
              </ul>              
            </li>            
          </div>

        </div>
      </nav>
</body>
