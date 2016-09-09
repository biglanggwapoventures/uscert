<div id="map" style="height:80vh" data-fetch="<?= site_url('gis/get_reports')?>">

</div>
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.3157, lng: 123.8854},
          zoom: 9,
         mapTypeId: google.maps.MapTypeId.HYBRID
        });

        $.getJSON($('#map').data('fetch'), function(response) {
            $.each(response, function(key, data) {
              if(data.latitude && data.longitude){
                  var latLng = new google.maps.LatLng(parseFloat(data.latitude), parseFloat(data.longitude)); 
                   
                  var marker = new google.maps.Marker({
                      position: latLng,
                      map: map,
                      title: data.formatted_address,
                      clickable:true,
                      icon: {
                        url: "<?= base_url('assets/img/flame.png')?>",
                        scaledSize: new google.maps.Size((369 / 11), (631 / 11))
                      }
                  });

                  marker.info = new google.maps.InfoWindow({
                    content: '<dl>'+
                          '<dt>INCIDENT TYPE</dt><dd>'+data.incident_type+'</dd>'+
                          '<dt>LOCATION</dt><dd>'+data.formatted_address+'</dd>'+
                          '<dt>RESPONDER</dt><dd>'+data.responder+'</dd>'+
                          '<dt>APPROVER</dt><dd>'+data.approver+'</dd>'+
                      '</dl><a class="text-center" href="<?= site_url('reports/edit/')?>/'+data.id+'">Click to view full report</a>'
                  });

                  marker.setMap(map)

                  
                  google.maps.event.addListener(marker, 'click', function() {
                    marker.info.open(map, marker);
                   
                    map.setCenter(latLng);
                     map.setZoom(20);
                  });

                  google.maps.event.addListener(marker.info, 'closeclick',function(){
                    map.setZoom(9);
                    
                  });

                  
                 
              }
            });
        });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb9gjcZGig7KAgoJC1EmMHA98Rp8Ayz98&callback=initMap" async defer></script>