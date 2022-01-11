@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Create Establishment</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-6 card p-3">
                <form action="" class="">
                    <fieldset class="border p-3 rounded-3">
                        <legend>Establishment</legend>
                        <div class="form-group mt-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name"
                                   placeholder="Name Establishment" value="{{old('name')}}">
                            @error('name')
                            <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="category">Category</label>
                            <select name="category_id" id="category"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if(old('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   value="{{old('image')}}">

                            @error('image')
                            <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="border p-3 rounded-3 mt-3">
                        <legend>Location</legend>
                        <div class="form-group mt-3">
                            <label for="location">Direction of the establishment</label>
                            <input type="text" class="form-control"
                                   id="location"
                                   name="location"
                                   placeholder="Location">
                        </div>
                        <p class="text-center mt-3">Move the pin on the location of the establishment</p>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
