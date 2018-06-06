@extends('layouts.app')

@section('content')
    @if(Auth::user()->name=="Admin")
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <h3>Manage Pubs</h3>
            <table class="table table-hover mt-3 text-center">
                <thead>
                    <tr>
                        <th scope="col">Pub Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pubs as $pub)
                        <tr>
                            <td>{{$pub->title}}</td>
                            <td><a href="{{route('pubs.edit',['id'=>$pub->id])}}"><button class="btn btn-info">Edit</button></a></td>
                            <td>
                                <form action="{{route('pubs.destroy',['id'=>$pub->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <h3 >Your comments</h3>
            @forelse($comments as $comment)
            <div class="card">
                <div class="card-header">{{$comment->created_at}} <span style="float:right">Pub: {{$comment->pubs->title}}</span></div>
                <div class="card-body">
                    {{$comment->comment}}
                </div>
            </div>
            <a href="{{route('edit_comment',['id'=>$comment->id])}}"><button class="btn btn-info mt-2 mb-2">Edit</button></a>
            <form action="{{route('delete_comment',['id'=>$comment->id])}}" method="POST" style="display:inline-block">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="btn btn-danger mt-2 mb-2">Delete</button>
            </form>
            @empty
            <p>You have made no comments</p>
            @endforelse
        </div>
    </div>
@endsection
