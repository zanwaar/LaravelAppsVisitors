<div>
    <div id="map2" wire:ignore style="width: 100%; height: 550px;"></div>
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
<link rel="stylesheet" href="https://opengeo.tech/maps/leaflet-gps/src/leaflet-gps.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endpush
@push('js')
<script type="text/javascript" src="https://opengeo.tech/maps/leaflet-gps/src/leaflet-gps.js"></script>
<script>
    document.addEventListener('livewire:load', function() {
        // Your JS here.

        var titikor = document.querySelector("[name=titikkor]");
        var map = L.map('map2').setView([-5.1475267571872605, 119.47171032428743], 17);
        var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/satellite-v9'
        }).addTo(map);
        var cor = [-0, 1]
        map.attributionControl.setPrefix(false);
        var marker = new L.marker(cor, {
            draggable: 'ture',
        });


        function onMapClick(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map)
            } else {
                marker.setLatLng(e.latlng)
            }

            titikor.value = lat + "," + lng;
        }
        map.addLayer(marker)

        function onMapdrag(e) {
            var pos = marker.getLatLng();
            marker.setLatLng(pos, {
                cor
            })
            $("#titikkor").val(pos.lat + "," + pos.lng);
        }

        map.on('click', onMapClick);
        marker.on('dragend', onMapdrag);
        var gps = new L.Control.Gps({
            autoActive: true,
            autoCenter: true
        }); //inizialize control

        gps
            .on('gps:located', function(e) {
                //	e.marker.bindPopup(e.latlng.toString()).openPopup()
                console.log(e.latlng, map.getCenter())
            })
            .on('gps:disabled', function(e) {
                e.marker.closePopup()
            });

        gps.addTo(map);
    })
</script>
<script>
    $('form').submit(function() {
        @this.set('titikkor', $('#titikkor').val());
    })
</script>
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush