@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- Esri Leaflet Geocoder -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"
    />
    <!--dropzone-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
          integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center">Create Establishment</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-lg-8 card p-3">
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
                            <label for="search">Direction of the establishment</label>
                            <input type="text" class="form-control"
                                   id="search"
                                   name="search"
                                   placeholder="Search Direction">
                        </div>
                        <p class="text-center mt-3">Move the pin on the location of the establishment</p>
                        <div class="form-group mt-3">
                            <div id="map" style="height: 400px;"></div>
                        </div>
                        <p class="text-center mt-3">Confirm the dates please</p>
                        <div class="form-group mt-3">
                            <label for="direction">Direction</label>
                            <input type="text" class="form-control @error('direction') is-invalid @enderror"
                                   id="direction"
                                   name="direction"
                                   value="{{old('direction')}}"
                                   placeholder="direction">
                        </div>
                        <div class="form-group mt-3">
                            <label for="suburb">Suburb</label>
                            <input type="text" class="form-control @error('suburb') is-invalid @enderror"
                                   id="suburb"
                                   name="suburb"
                                   value="{{old('suburb')}}"
                                   placeholder="suburb">
                        </div>
                        <input type="hidden" name="lat" id="lat" value="{{old('lat')}}">
                        <input type="hidden" name="lng" id="lng" value="{{old('lng')}}">
                    </fieldset>
                    <fieldset class="border p-3 rounded-3 mt-3">
                        <legend>Establishment Information</legend>
                        <div class="form-group mt-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control"
                                   id="phone"
                                   name="phone"
                                   placeholder="Phone Number">
                        </div>
                        <div class="form-group mt-3">
                            <label for="direction">Description</label>
                            <textarea class="form-control"
                                      id="description"
                                      name="description"
                                      placeholder="Description">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="open_time">Opening time</label>
                            <input type="time" class="form-control @error('open_time') is-invalid @enderror"
                                   id="open_time"
                                   name="open_time"
                                   value="{{old('open_time')}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="close_time">Closing time</label>
                            <input type="time" class="form-control @error('close_time') is-invalid @enderror"
                                   id="close_time"
                                   name="close_time"
                                   value="{{old('close_time')}}">
                        </div>
                    </fieldset>
                    <fieldset class="border p-3 rounded-3 mt-3">
                        <legend>Information Establishment</legend>
                        <div class="form-group mt-3">
                            <label for="dropzone">Images</label>
                            <div id="dropzone" class="dropzone form-control"></div>
                        </div>
                    </fieldset>
                    <input type="hidden" id="uuid" name="uuid" value="{{Str::uuid()->toString()}}">
                    <input type="submit" class="mt-3 btn btn-dark d-block" value="Save Establishment">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet-src.js" defer></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
    <!-- Make sure you put this AFtER leaflet.js, when using with leaflet -->
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js" defer></script>
    <!--Dropzone-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"
            integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
