<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class AdminController extends Controller
{

    public function adminSignin(Request $req){
        $username = $req->input('username');
        $password = $req->input('password');

        $checkLogin = DB::table('administrators')->where(['username'=>$username, 'password'=>$password])->get();
        if(count ($checkLogin) > 0){
            echo "Welcome! ".$username;

        }
        else{
            echo "Login Failed";
        }}
}