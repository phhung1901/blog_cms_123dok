<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\c;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Auth::check()){
            return view("admin.auth.login" ,[
                "title" => "Admin Login",
            ]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *login
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
           'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!$validate->fails()){
            if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])){
                return redirect()->route("admin.dashboard.view");
            }else{
                return redirect()->back()->with('error', 'Pls, login agian!');
            }
        }else{
            return redirect()->route("admin.login.view")->with('error', 'Pls, check input login!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
        return redirect()->route("admin.login.view");
    }
}
