<?php

namespace App\Http\Middleware;

use Closure;
use App\Vote;
use Illuminate\Support\Facades\Auth;

class VoteCountCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pubToVote=Vote::where('pub_id',$request->route('id'))->where('user_id',Auth::user()->id)->count();
        if($pubToVote>0){
            return redirect(route('home'))->with('message','You can not vote for the same pub twice.');
        }else{
            return $next($request);
        }
    }
}
