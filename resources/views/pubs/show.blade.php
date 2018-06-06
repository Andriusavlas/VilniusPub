@extends('layouts.app')

@section('content')
    @include('includes.infoalert')
    <div class="row mt-5">
        <div class="col-6">
            <iframe
                width="100%"
                height="450"
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB3gdZOwBPzK4umv9kqQf1a-ionBHw-1Uo&q={{$pub_location}}" allowfullscreen>
            </iframe>
            @auth
                <form action="{{route('add_comment',['id'=>$pub->id])}}" method="POST" class="mt-2">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" id="comment" cols="75" rows="5" class="form-control" placeholder="Leave a comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Add comment</button>
                </form>
            @endauth
            @guest
                <h3 class="mt-5">Log in to leave a comment</h3>
            @endguest
        </div>
        <div class="col-6">
            <h2>{{$pub->title}}</h2>
            @if($pub->attachment != null)
            <img src="../storage/{{$pub->attachment->laravel_name}}" style="width:100%" alt="pub_image" class="mb-2">
            @endif
            <h3>About</h3>
            <p>{{$pub->description}}</p>
            <h3>Comments</h3>
            @forelse($pub->comments as $com)
                <div class="card mb-3">
                    <div class="card-header">
                        Written on: {{$com->created_at}}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p style="font-size:0.9rem">{{$com->comment}}</p>
                        <footer class="blockquote-footer">{{$com->user_name}}</footer>
                        </blockquote>
                    </div>
                </div>
            @empty
                <h6>No comments yet</h6>
            @endforelse
        </div>
    </div>
@endsection