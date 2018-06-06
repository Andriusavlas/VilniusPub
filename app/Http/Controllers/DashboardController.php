<?php

namespace App\Http\Controllers;

use App\Pub;
use App\Comment;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pubs=Pub::all();
        $comments=Comment::where('user_id',$id)->get();
        return view('user.dashboard',['comments'=>$comments,'pubs'=>$pubs]);
    }
}
