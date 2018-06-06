@extends('layouts.app')

@section('content')
    @include('includes.errors')
    <div class="row justify-content-center mt-2">
        <h2>Pub information</h2>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-6">
            <form action="{{route('pubs.update',['id'=>$pub->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put">
                @csrf
                <div class="form-group">
                    <label for="title">Pub title</label>
                    <input type="text" name="title" id="title" value="{{$pub->title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="location">Pub location</label>
                    <input type="text" name="location" id="location" value="{{$pub->location}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Short description</label>
                    <textarea name="description" id="description" rows="5" class="form-control">{{$pub->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number (86/85*)</label>
                    <input type="tel" name="phone_number" id="phone_number" value="{{$pub->phone_number}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" name="picture" style="display:block">
                </div>
                <button type="submit" class="btn btn-success">Update information</button>
            </form>
        </div>
    </div>
@endsection