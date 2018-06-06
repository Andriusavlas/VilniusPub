@extends('layouts.app')

@section('content')
    @include('includes.errors')
    <div class="row justify-content-center mt-2">
        <h2>Pub information</h2>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-6">
            <form action="{{route('pubs.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Pub title</label>
                    <input type="text" name="title" id="title" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="location">Pub location</label>
                    <input type="text" name="location" id="location" placeholder="Location" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Short description</label>
                    <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone number (86/85*)</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Telephone number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="file" name="picture" style="display:block">
                </div>
                <button type="submit" class="btn btn-success">Add new pub</button>
            </form>
        </div>
    </div>
@endsection