<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Street View controls</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
   <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script>
var myGeocoder = ymaps.geocode("Петрозаводск");
myGeocoder.then(
    function (res) {
        alert('Координаты объекта :' + res.geoObjects.get(0).geometry.getCoordinates());
    },
    function (err) {
        alert('Ошибка');
    }
);

    </script>
  </head>
  <body>
    <div id="map"></div>
    
    
  </body>
</html>