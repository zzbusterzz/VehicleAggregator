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
        
        
        if (strpos($username, 'cus_') === 0) {
            $checkLogin = DB::table('customers')->where(['username'=>str_replace("cus_","",$username)])->get();
            $userType = 0;
        } else if(strpos($username, "sp_") === 0){
            $checkLogin = DB::table('service_providers')->where(['username'=>str_replace("sp_","",$username)])->get();
            $userType = 1;
        } else if(strpos($username, "ven_") === 0){
            $checkLogin = DB::table('vendors')->where(['username'=>str_replace("ven_","",$username)])->get();
            $userType = 2;
        }


       

        if (Hash::check($req->input('password'), $checkLogin->first()->password))
        {
            // The passwords match...
            echo "Login Successfull";
            $id = $checkLogin->first()->id;

            $req->session()->put('user_id', $id);
            $req->session()->put('user_name', $username);

            //Redirect here based on customer,vendor,ServivceProvider
            //return redirect('customerdashboard');//default return is customer dashboard
            //return redirect('vendordashboard');//redirect to vendor dashboard
            //return redirect('spdashboard');//redirect to SP dashboard


            //endsWith function is above logiin function
            // if(beginsWith($username, "cus_")){
            //     return redirect('customerdashboard');
            // } else if(endsWith($username, "sp_")){
            //     return redirect('spdashboard');
            // } else if(endsWith($username, "ven_")){
            //     return redirect('vendordashboard');
            // }

            if($userType == 0){
                return redirect('customerdashboard');
            } else if($userType == 1){
                return redirect('spdashboard');
            } else if($userType == 2){
                return redirect('vendordashboard');
            }

        } else{
            echo "Login Failed";
        }
    }
}
