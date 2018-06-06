<?php

namespace App\Http\Controllers;

use App\Pub;
use App\Vote;
use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PubsController extends Controller
{
    public function __construct(){
        $this->middleware('is_admin',['except'=>['index','show','vote']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pubs = Pub::withCount('votes')->orderBy('votes_count','desc')->paginate(20);
        return view('pubs.index',['pubs'=>$pubs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pubs',
            'location' => 'required|unique:pubs',
            'description' => 'required|max:10000',
            'phone_number' => 'required|'
        ]);
        $pub=new Pub;
        $pub->title=$request->input('title');
        $pub->location=$request->input('location');
        $pub->description=$request->input('description');
        $pub->phone_number=$request->input('phone_number');
        $pub->save();
        if($request->hasFile('picture')){
            $attachment=$request->picture;
            $original_name=$attachment->getClientOriginalName();
            $path=Storage::putFile('public',$attachment);
            $pub_picture=new Attachment;
            $pub_picture->pub_id=$pub->id;
            $pub_picture->path=$path;
            $pub_picture->original_name=$original_name;
            $pub_picture->laravel_name=$attachment->hashName();
            $pub_picture->save();
        }
        return redirect(route('home'))->with('message','Pub added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pub=Pub::find($id);
        $pub_location=urlencode($pub->title." ".$pub->location);
        return view('pubs.show',['pub'=>$pub,'pub_location'=>$pub_location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pub=Pub::find($id);
        return view('pubs.edit')->with('pub',$pub);
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
        $pub=Pub::find($id);
        $pub->title=$request->input('title');
        $pub->location=$request->input('location');
        $pub->description=$request->input('description');
        $pub->phone_number=$request->input('phone_number');
        $pub->save();
        $att=Attachment::where('pub_id',$id);
        if($att->count()==0 && $request->hasFile('picture')){
            $attachment=$request->picture;
            $original_name=$attachment->getClientOriginalName();
            $path=Storage::putFile('public',$attachment);
            $pub_picture=new Attachment;
            $pub_picture->pub_id=$pub->id;
            $pub_picture->path=$path;
            $pub_picture->original_name=$original_name;
            $pub_picture->laravel_name=$attachment->hashName();
            $pub_picture->save();            
        }
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
        Pub::destroy($id);
        return redirect(route('dashboard',['id'=>Auth::user()->id]));
    }
    public function vote($id)
    {
        $pub_id=$id;
        $vote=new Vote;
        $vote->user_id=Auth::user()->id;
        $vote->pub_id=$pub_id;
        $vote->save();
        return redirect(route('home'))->with('message','Vote addedd successfully.');
    }
}
