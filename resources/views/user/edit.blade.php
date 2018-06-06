@extends('layouts.app')

@section('content')
    <form action="{{route('update_comment',['id'=>$comment->id])}}" method="POST" class="mt-5">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <textarea name="comment" id="comment" cols="75" rows="5" class="form-control">{{$comment->comment}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Edit comment</button>
    </form>
@endsection