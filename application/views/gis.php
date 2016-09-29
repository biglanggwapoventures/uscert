<form action="" onsubmit="return false;">
  <div class="form-group" >
    <input type="text" class="form-control" name="search" onkeyup="getAddress(this, event)"/>
  </div>
</form>
<?php if(user('login_type') !== 'sa'): ?>
<div class="alert alert-info">
  Click anywhere on the map to add new water source. 
</div>
<?php endif; ?>
<div id="map" style="height:80vh" data-fetch="<?= site_url('gis/get-reports')?>" data-fetch-hydrant="<?= site_url('gis/get-markers')?>"> 

</div>
<script>
      var map, geocoder, markerArray = [];
      $(document).ready(function(){

        //CREATE MARKER CODE START
        $('#map').on('submit', '.save-marker', function(e){
          e.preventDefault();
          var url =  "<?= site_url('gis/save-marker')?>",
              $this = $(this),  
              submitBtn = $this.find('[type=submit]'),
              alert = $this.find('.alert');
          
          submitBtn.addClass('disabled');
          alert.addClass('hidden').html('');
          
          $.post(url, $this.serialize())
            .done(function(response){
                if(response.result){
                  if(response.hasOwnProperty('data') && response.data.hasOwnProperty('id')){
                    $this.prepend($('<input />', {
                      type: 'hidden',
                      name: 'id',
                      value: response.data.id
                    }));
                  }
                  var status = $('<i />', {
                    'class': 'fa fa-check text-success',
                    'style': 'margin-left:10px'
                  });
                  submitBtn.after(status);
                  status.fadeOut(3000);
                  return;
                }
                alert.removeClass('hidden').html($('<ul />', {
                  'class': 'list-unstyled',
                  html: function(){
                    return '<li>'+response.errors.join('</li><li>')+'</li>'
                  }
                }));

            }).always(function(){
              submitBtn.removeClass('disabled');
            })
          
        })
        //CREATE MARKER CODE END
        $('#map').on('click', '.remove-marker', function(e){
            var url = "<?= site_url('gis/remove-marker')?>",
              $this = $(this),
              form = $this.closest('form')
              key = form.find('[name=key]').val(),
              id = form.find('[name=id]');

              if(id.length){
                console.log(id.val())
                $.post(url, {id: id.val()});
              }

            // 
            markerArray[key].setMap(null);
        })
      })
     
      function getAddress(el, e){
        if(e.keyCode === 13){
          geocodeAddress(el.value, geocoder, map);
        }
      }

      function markerForm(address, lat, lng, arrKey, id, status){
        var idField = '<input type="hidden" name="id" value="'+id+'">';
        return '<fieldset>'+
          '<form class="save-marker clearfix">'+
              '<legend>'+address+'</legend>'+
              '<div class="alert alert-danger hidden"></div>'+
              '<div class="form-group">'+
                  '<label>Status</label>'+
                  '<select class="form-control input-xs" name="status">'+
                      '<option></option>'+
                      '<option value="1" '+(status !== null && status ? 'selected' : '')+'>Available</option>'+
                      '<option value="0" '+(status !== null && !status ? 'selected' : '')+'>Unavailable</option>'+
                  '</select>'+
                  '<input type="hidden" name="latitude" value="'+lat+'"/>'+
                  '<input type="hidden" name="longitude" value="'+lng+'"/>'+
                  '<input type="hidden" name="formatted_address" value="'+address+'"/>'+
                  '<input type="hidden" name="key" value="'+arrKey+'"/>'+
                  (id ? idField : '')+
              '</div>'+
              '<button class="btn btn-xs btn-success" type="submit">Save</button> '+
              '<button class="btn btn-xs btn-danger remove-marker pull-right" type="button">Remove</button>'+
          '</form>'+
        '</fieldset>';
      }

      function geocodeAddress(e, geocoder, resultsMap) {
        geocoder.geocode({'address': e}, function(results, status) {
          if (status ===  google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            map.setZoom(20)
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

      function setHydrantMarker(latLng, address, id, status){
        var marker = new google.maps.Marker({
            position: latLng, 
            map: map,
            info: new google.maps.InfoWindow({
              content: markerForm(address, latLng.lat(), latLng.lng(), markerArray.length, id, status)
            }),
            icon: {
              url: "<?= base_url('assets/img/hydrant.png')?>",
              scaledSize: new google.maps.Size((416 / 13), (416 / 13))
            }
        });
        if(!id){
           marker.info.open(map, marker);
        }
       
        google.maps.event.addListener(marker, 'click', function() {
          marker.info.open(map, marker);
        });
        markerArray.push(marker);
      }


      function initMap() {

        var icons = {
          FLOOD: {
            url: "<?= base_url('assets/img/flood.png')?>",
            size: new google.maps.Size((163 / 5), (166 / 5))
          },
          FIRE:  {
            url: "<?= base_url('assets/img/fire.png')?>",
            size: new google.maps.Size((120 / 3.5), (120 / 3.5))
          },
          EARTHQUAKE:  {
            url: "<?= base_url('assets/img/earthquake.png')?>",
            size: new google.maps.Size((163 / 5), (166 / 5))
          },
          CRASH:  {
            url: "<?= base_url('assets/img/crash.png')?>",
            size: new google.maps.Size((120 / 3.5), (120 / 3.5))
          }
        };
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.3157, lng: 123.8854},
          zoom: 9,
         mapTypeId: google.maps.MapTypeId.HYBRID
        });
        geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(map, 'click', function(event) {
          geocoder.geocode({'latLng': event.latLng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              <?php if(user('login_type') !== 'sa'):?>
              setHydrantMarker(event.latLng, results[0].formatted_address, false, null)
              <?php endif; ?>
            }
          });
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
                        url: icons[data.incident_type].url,
                        scaledSize: icons[data.incident_type].size,
                      },
                      draggable: true
                  });

                  marker.info = new google.maps.InfoWindow({
                    content: '<dl>'+
                          '<dt>INCIDENT TYPE</dt><dd>'+data.incident_type+'</dd>'+
                          '<dt>LOCATION</dt><dd>'+data.formatted_address+'</dd>'+
                          '<dt>RESPONDER</dt><dd>'+data.responder+'</dd>'+
                          '<dt>APPROVER</dt><dd>'+data.approver+'</dd>'+
                      '</dl><a class="text-center" href="<?= site_url('reports/edit/')?>/'+data.id+'">Click to view full report</a>',
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

        $.getJSON($('#map').data('fetch-hydrant'), function(response){
          $.each(response, function(key, data){
             var latLng = new google.maps.LatLng(parseFloat(data.latitude), parseFloat(data.longitude)); 
             setHydrantMarker(latLng, data.formatted_address, data.id, parseInt(data.status) === 1)
          })
        })
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb9gjcZGig7KAgoJC1EmMHA98Rp8Ayz98&callback=initMap" async defer></script>