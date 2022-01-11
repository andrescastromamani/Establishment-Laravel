@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
@endsection
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
                        <input type="hidden" name="latitude" id="latitude" value="{{old('latitude')}}">
                        <input type="hidden" name="longitude" id="longitude" value="{{old('longitude')}}">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lat = -17.3949854;
            const lng = -66.0581133;
            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            const marker = L.marker([lat, lng], {
                draggable: true,
                autoPan: true
            }).addTo(map);
            //Detect when the marker is moveend
            marker.on('moveend', function (e) {
                const position = marker.getLatLng();
                //center map on marker
                map.panTo(position);
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });
        });
    </script>
@endsection
