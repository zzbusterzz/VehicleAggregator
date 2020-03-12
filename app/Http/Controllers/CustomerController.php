<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
//use DB;

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
        return view('customer.create');
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
            'password_confirmation' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $customers = new Customer([
            'username' => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'password' => $request->get('password'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
        ]);
        $customers->save();

        // $username = $request->get('username');
        // $firstname = $request->get('firstname');
        // $lastname = $request->get('lastname');
        // $password = $request->get('confirmpass');
        // $phone = $request->get('phone');
        // $email = $request->get('email');

        // DB::insert('insert into customers  (id, username, firstname, lastname, password, phone, email)
        //                             values (?, ?, ?, ?, ?, ?, ?)', [null, $username, $firstname, $lastname, $password, $phone, $email]);

        return redirect()->route('customer.create')->with('success', 'Registration Complete. Please LOGIN!');
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
