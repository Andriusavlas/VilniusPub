@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <h1>Visit. Drink. Rate.</h1>
    </div>
    <table class="table table-hover mt-5 text-center">
        <thead>
            <tr>
                <th scope="col">Pub Name</th>
                <th scope="col">Location</th>
                <th scope="col">Votes</th>
                <th scope="col">Upvote</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pubs as $pub)
                <tr>
                    <td><a href="{{route('pubs.show',['id'=>$pub->id])}}">{{$pub->title}}</a></td>
                    <td>{{$pub->location}}</td>
                    <td>{{$pub->votes->count()}}</td>
                    <td>
                        @auth
                            <form action="{{route('vote',['id'=>$pub->id])}}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary">+1</button>
                            </form>
                        @endauth
                        @guest
                            <p>Log in or register to vote.</p>
                        @endguest
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$pubs->links()}}
@endsection