<?php

namespace App\Http\Middleware;

use Closure;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CheckCommentAuthor
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
        $comment=Comment::find($request->route('id'));
        if($comment->user_id == Auth::user()->id){
            return $next($request);
        }else{
            return redirect(route('home'))->with('message','You can only edit/delete your comments.');
        }
    }
}
