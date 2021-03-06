<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }

    public function login(Request $req) {

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $req->input('username');
        $utype = $req->input('usertype');
        
        if($utype == "cus_") {
            $checkLogin = DB::table('customers')->where(['username'=>$username])->get();
        } else if($utype == "sp_"){
            $checkLogin = DB::table('service_providers')->where(['username'=>$username])->get();
        } else if($utype == "ven_"){
            $checkLogin = DB::table('vendors')->where(['username'=>$username])->get();
        }


        if ( !$checkLogin->isEmpty() && Hash::check($req->input('password'),optional($checkLogin)->first()->password))
        {
            // The passwords match...
            echo "Login Successfull";
            $req->session()->put('usertype', $utype);
            $req->session()->put('user_id', $checkLogin->first()->id);
            $req->session()->put('user_name', $username);

            //Redirect here based on customer,vendor,ServivceProvider
            if($utype == "cus_") {
                return redirect('customerdashboard');
            } else if($utype == "sp_"){
                return redirect('spdashboard');
            } else if($utype == "ven_"){
                return redirect('vendordashboard');
            }

        } else{
            return redirect()->route('login')->with('warning', 'Login Failed. Please Check Username or Password!');
            echo "Login Failed";
        }
    }

    public function logout(Request $req) {
        Auth::logout();
        Session::flush();
        return Redirect::to('login');
    }
}
