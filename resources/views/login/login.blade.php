@extends('master')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">



    </head>
    <body>
        <form action="/loginme" method="POST">
            {{csrf_field()}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <input type="text" name="username" required="" class="form-control" placeholder="Enter Username :" />
        </div>
        <div class="form-group">
            <input type="password" name="password" required="" class="form-control" placeholder="Enter Password :" />
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Log IN" class="btn btn-primary"/>
        </div>

        </form>
    </body>
</html>

@endsection
