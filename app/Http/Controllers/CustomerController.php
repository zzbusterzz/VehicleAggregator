<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Customer;
use App\ServiceProvider;
use App\Vendor;
use DB;


class CustomerController extends Controller
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
        return view('customer.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $password = Hash::make($request->get('password'));
        //$output->writeln($password);
        echo $password ;

        if($request->get('usertype') == "cus_"){
            $customers = new Customer([
                'username' => $request->get('username'),
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'password' => $password,
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
            ]);


            $customers->save();
        } elseif($request->get('usertype') == "sp_" ){
            $customers = new ServiceProvider([
                'username' => $request->get('username'),
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'password' => $password,
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
            ]);
            $customers->save();
        } elseif($request->get('usertype') == "ven_" ){
            $customers = new Vendor([
                'username' => $request->get('username'),
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'password' => $password,
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
            ]);

            $customers->save();
        }

        return redirect()->route('customer.create')->with('success', 'Registration Complete. Please LOGIN!');
    }

    public function updateUserProfile(Request $request){

        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $phone = $request->input('phone');
        $email = $request->input('email');


        $utype = $request->session()->get('usertype');
        $userid =  $request->session()->get('user_id');

        $table = 'customers';
        if($utype == "sp_"){
            $table = 'service_providers';
        } else if($utype == "ven_"){
            $table = 'vendors';
        }

        $result = DB::table($table)
                            ->where(['id'=>$userid])
                            ->update(['firstname' => $fname, 'lastname' => $lname, 'phone' => $phone,  'email' => $email]);

        if($result == 1){
            return back()->with('infoprofile','Info updated successfully');
        }else{
            return back()->with('errorprofile','Problem in updating info');
        }
    }

    public function updateUserPassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|min:6|same:new_password'
        ]);

        $utype = $request->session()->get('usertype');
        $userid =  $request->session()->get('user_id');

        $password = Hash::make($request->get('new_password'));

        if($utype == "cus_") {
            $checkLogin = DB::table('customers')->where(['id'=>$userid])->get();
        } else if($utype == "sp_"){
            $checkLogin = DB::table('service_providers')->where(['id'=>$userid])->get();
        } else if($utype == "ven_"){
            $checkLogin = DB::table('vendors')->where(['id'=>$userid])->get();
        }

        if(!$checkLogin->isEmpty() && !Hash::check($request->input('old_password'), optional($checkLogin)->first()->password)){
            return back()->with('errorpwd','The specified password does not match the database password');
        }else{
            //Update
            $table = 'customers';
            if($utype == "sp_"){
                $table = 'service_providers';
            } else if($utype == "ven_"){
                $table = 'vendors';
            }

            $checkLogin = DB::table($table)->where(['id'=>$userid])->update(['password' => $password]);

            if($checkLogin == 1){
                return back()->with('infopwd','Password changed successfully');
            }else{
                return back()->with('errorpwd','Problem in updating password');
            }
        }
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
}
