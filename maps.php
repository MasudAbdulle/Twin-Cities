<?php

require_once 'dbh.inc.php';



$result = $conn->query("SELECT * FROM place_of_interest");

$result2 = $conn->query("SELECT * FROM place_of_interest");
$result3 = $conn->query("SELECT * FROM place_of_interest") ;

$result4 = $conn->query("SELECT * FROM place_of_interest") ;

$result5 = $conn->query("SELECT * FROM place_of_interest") ;



?>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEQyAUPRWfhsq0xkgYtEEO9LbnLrebxYU"></script>
    <script>

function initMap() {
    var map; 
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {

        mapTypeId: 'roadmap',
        center: {lat:51.5072,lng: 0.1276},
        zoom: 10,
        mapTypeControl: false,
        zoomControl: false,
        scaleControl: false,
        streetViewControl: false,
        fullscreenControl: false
    };
                    
    
    
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    

    
    
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($result3->num_rows > 0){ 
            while($row = $result3->fetch_assoc()){ 
                echo '["'.$row['place_name'].'", '.$row['place_lat'].', '.$row['place_long'].',"'.$row['URL'].'"],'; 
            } 
        } 
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($result4->num_rows > 0){ 
            while($row = $result4->fetch_assoc()){ ?>
                ['<div class="info_content"> <h3><?php echo $row['place_name']. "<br>".$row['category']; ?></h3>'],
                
        <?php } 
        } 
        ?>
    ];

   
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
     // Place each marker on the map  
     for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            
        
            
            title: markers[i][0]

        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                
                infoWindow.open(map, marker);
                
            }
        })(marker, i));

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              
            window.open(markers[i][3], '_blank');
                }
            
        })(marker, i));
        


        // Center the map to fit all markers on the screen
     //   map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(10);
        this.setCenter()

        google.maps.event.removeListener(boundsListener);
    });
  }

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
function initMap2() {
    var map2;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {

        mapTypeId: 'roadmap',
        center: {lat:40.7128,lng: -74.006},
        zoom: 10,
        mapTypeControl: false,
        zoomControl: false,
        scaleControl: false,
        streetViewControl: false,
        fullscreenControl: false
    };
                    
    
    
    map2 = new google.maps.Map(document.getElementById("map2"), mapOptions);
    

    
    
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['place_name'].'", '.$row['place_lat'].', '.$row['place_long'].',"'.$row['URL'].'"],';
            } 
        } 
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content"> <h3><?php echo $row['place_name']. "<br>".$row['category']; ?></h3>'],
        <?php } 
        } 
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
     // Place each marker on the map  
     for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map2,
		
            title: markers[i][0]
        });
        



        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              
                window.open(markers[i][3], '_blank');
                }
            
        })(marker, i));
        // Add info window to marker    
        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map2, marker);
                
            }
        })(marker, i));

       
    }
    

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map2), 'bounds_changed', function(event) {
        this.setZoom(10);
        this.setCenter()

        google.maps.event.removeListener(boundsListener);
    });
  }

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap2);
</script>