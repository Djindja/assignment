<div id="map" style="width: 100%; height: 100%;"></div>

<script type="text/javascript"
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js">
</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script src="{{url("js/loadgpx.js")}}"></script>

<script>

function loadGPXFileIntoGoogleMap(map, filename) {
    $.ajax({url: filename,
        dataType: "xml",
        success: function(data) {
          var parser = new GPXParser(data, map);
          parser.setTrackColour("#ff0000");     // Set the track line colour
          parser.setTrackWidth(5);          // Set the track line width
          parser.setMinTrackPointDelta(0.001);      // Set the minimum distance between track points
          parser.centerAndZoom(data);
          parser.addTrackpointsToMap();         // Add the trackpoints
          parser.addRoutepointsToMap();         // Add the routepoints
          parser.addWaypointsToMap();           // Add the waypoints
        }
    });
}

$(document).ready(function() {
    var mapOptions = {
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);
    loadGPXFileIntoGoogleMap(map, "/uploads/{{ $trip->filename }}");
});

</script>