<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

class AdminController extends backendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back_end.home.index');
    }
}
