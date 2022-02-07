import {OpenStreetMapProvider} from 'leaflet-geosearch';

const provider = new OpenStreetMapProvider();
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#map')) {
        const lat = document.querySelector('#lat').value === '' ? -17.3937938 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? -66.1591493 : document.querySelector('#lng').value;
        const map = L.map('map').setView([lat, lng], 13);
        //markers
        const markers = L.featureGroup().addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        const marker = L.marker([lat, lng], {
            draggable: true, autoPan: true
        }).addTo(map);
        //add to markers
        markers.addLayer(marker);

        //Geocode service
        const apiKey = "AAPKadc3f8c4eef24ed9a1661108b18757e3GCFAMQ9s5jtK-QxcX8Iyz34ROvTYWRjf8BELicUVCvNX3Dbw5NJ6KJ46CYUvYjsx"
        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: apiKey
        });
        //Search service
        const search = document.querySelector('#search');
        search.addEventListener('blur', searchDirection)

        //Detect when the marker is moveend
        movePin(marker);

        function movePin(marker) {
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
        }

        function searchDirection(e) {
            //console.log(provider)
            if (e.target.value.length > 5) {
                provider.search({
                    query: e.target.value
                }).then(result => {
                    if (result) {
                        //delete markers
                        markers.clearLayers();
                        geocodeService.reverse().latlng(result[0].bounds[0]).run(function (error, result) {
                            showInputs(result);
                            map.setView(result.latlng);
                            const marker = L.marker(result.latlng, {
                                draggable: true, autoPan: true
                            }).addTo(map);
                            markers.addLayer(marker);
                            //move marker
                            movePin(marker);
                        });
                    }
                }).catch(error => {
                    console.log(error)
                })
            }
        }

        function showInputs(result) {
            //console.log(result);
            document.getElementById('direction').value = result.address.Address || '';
            document.getElementById('suburb').value = result.address.City || '';
            document.getElementById('lat').value = result.latlng.lat || '';
            document.getElementById('lng').value = result.latlng.lng || '';
        }
    }
});
