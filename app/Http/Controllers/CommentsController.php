<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:20',
        ]);
        $comment=new Comment;
        $comment->comment=$request->input('comment');
        $comment->user_id=Auth::user()->id;
        $comment->pub_id=$id;
        $comment->user_name=Auth::user()->name;
        $comment->save();
        return redirect(route('pubs.show',['id'=>$id]));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment=Comment::find($id);
        return view('user.edit')->with('comment',$comment);
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
        $request->validate([
            'comment' => 'required|min:20',
        ]);
        $comment=Comment::find($id);
        $comment->comment=$request->input('comment');
        $comment->save();
        return redirect(route('dashboard',['id'=>Auth::user()->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect(route('home'))->with('message','Comment destroyed successfully.');
    }
}
