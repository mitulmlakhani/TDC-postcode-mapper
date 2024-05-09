<!DOCTYPE html>
<html>

<head>
  <title>Markers</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    #mapWrap {
      width: 100%;
      height: 100vh;
      max-height: calc(100vh - 56px);
    }
  </style>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  @include('common/header')
  
  <div id="loader" style="display: none;" class="align-items-center justify-content-center bg-danger">
    <span class="p-2 text-white"><strong>Loading Markers...</strong></span>
  </div>
  <div id="mapWrap"></div>

  <script>
    function hideLoader() {
      document.getElementById("loader").style.display = "none";
    }

     function showLoader() {
      document.getElementById("loader").style.display = "flex";
     }
  </script>

  <script>
    const latitude = 53.8684021;
    const longitude = -1.9020456;
    const zoom = 14;

    var mymap = L.map("mapWrap");

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}", {
      foo: "bar",
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(mymap);

    mymap.setView([latitude, longitude], zoom);
  </script>

  <script>
    showLoader();
    function addMarkers(markers) {

      var mmr = [];

      for (let id = 0; id < markers.length; id++) {

        const marker = markers[id];

        mmr[id] = L.marker([0, 0]);
        mmr[id].bindPopup("0,0");
        mmr[id].addTo(mymap);

        mmr[id].setLatLng(L.latLng(marker.latitude, marker.longitude));

        mmr[id].on("click", function() {
          mmr[id].setPopupContent(marker.title).openPopup();
        });
      }

      hideLoader();
    }

   fetch("api/markers")
     .then((response) => response.json())
     .then((json) => { hideLoader(); addMarkers(json); })
     .catch(() => {
      hideLoader();
     });

  </script>
</body>

</html>