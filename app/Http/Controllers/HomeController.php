<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = \Auth::user()->id;

        $userInfo = User::findOrFail($id);

        $data = array(
            'user_id' => $userInfo->id,
            'user_image' => $userInfo->image,
            'is_login' => TRUE
        );
        
        session()->put($data);

        return view('home',['title' => "Dashboard", 'customJs' => 'dashboard-js']);
    }
}
