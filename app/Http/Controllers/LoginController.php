<?php

namespace App\Http\Controllers;

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
        //
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

    public function login(Request $req) {

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $req->input('username');
        $password = $req->input('password');

        // $checkLogin = Customer::where([
        //     'username' => $username,
        //     'password' => $password
        // ])->get();

        $checkLogin = DB::table('customers')->where(['username'=>$username, 'password'=>$password])->get();
        if(count ($checkLogin) > 0){
            echo "Login Successfull";
            $id = $checkLogin->first()->id;

            
            $req->session()->put('user_id', $id);
            $req->session()->put('user_name', $username);
            return redirect('dashboard');
           // return redirect()->route('dashboard');
        }
        else{
            echo "Login Failed";
        }

      
        //redirect()->route('customer.create');
    }
}
