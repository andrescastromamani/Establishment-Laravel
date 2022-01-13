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
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center">Create Establishment</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 card p-3">
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet-src.js"></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet"></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder"></script>
    <!-- Make sure you put this AFtER leaflet.js, when using with leaflet -->
    <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
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

            //Geocode service
            const apiKey = "AAPKadc3f8c4eef24ed9a1661108b18757e3GCFAMQ9s5jtK-QxcX8Iyz34ROvTYWRjf8BELicUVCvNX3Dbw5NJ6KJ46CYUvYjsx"
            const geocodeService = L.esri.Geocoding.geocodeService({
                apikey: apiKey
            });
            //Search service
            const searchControl = L.esri.Geocoding.geosearch({
                providers: [
                    L.esri.Geocoding.arcgisOnlineProvider({
                        apikey: apiKey
                    })]
            });
            const search = document.querySelector('#search');
            search.addEventListener('blur', searchDirection)

            //Detect when the marker is moveend
            marker.on('moveend', function (e) {
                const position = marker.getLatLng();
                //center map on marker
                map.panTo(new L.LatLng(position.lat, position.lng));
                //geocode marker position
                geocodeService.reverse().latlng(position).run(function (error, result) {
                    marker.bindPopup(result.address.Match_addr).openPopup();
                    showInputs(result);
                });
            });

            function searchDirection(e) {
                console.log(searchControl);
                console.log(e.target.value);
                if (e.target.value > 1) {

                }
            }

            function showInputs(result) {
                console.log(result);
                document.getElementById('direction').value = result.address.Address || '';
                document.getElementById('suburb').value = result.address.City || '';
                document.getElementById('lat').value = result.latlng.lat || '';
                document.getElementById('lng').value = result.latlng.lng || '';
            }
        });
    </script>
@endsection
