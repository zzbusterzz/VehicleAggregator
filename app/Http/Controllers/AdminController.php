<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class AdminController extends Controller
{

    public function create()
    {
        return view('login.adminLogin');
    }

    public function adminLogin(Request $request) {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // $checkLogin = Customer::where([
        //     'username' => $username,
        //     'password' => $password
        // ])->get();

        $checkLogin = DB::table('administrators')->where(['username'=>$username, 'password'=>$password])->get();
        if(count ($checkLogin) > 0){
            echo "Login Successfull";
            $id = $checkLogin->first()->id;


            $request->session()->put('user_id', $id);
            $request->session()->put('user_name', $username);
            return redirect('dashboard');
           // return redirect()->route('dashboard');
        }
        else{
            echo "Login Failed";
        }
        //redirect()->route('customer.create');
    }
}
