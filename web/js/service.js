var dmap = angular.module('dmap');

dmap.service('PlacesApi', ['$http', 'global', function($http, $global){

  this.get = function(success, error){

    $http.get($global.url('/places')).then(function(response){
      success(response);
    }, function(response){
      error(response);
    });

  };

  this.save = function(data, success, error) {
    $http.post($global.url('/places'), data).then(function(response){
      
      data._id = {};
      data._id.$id = response.data.id;

      success(response);
    }, function(response){
      error(response);
    });

  };

  this.delete = function(id, success, error){
    $http.delete($global.url('/places/'+id)).then(function(response){
      success(response);
    }, function(response){
      error(response);
    });
  };

  this.update = function(id, data, success, error){

    $http.put($global.url('/places/'+id), data).then(function(response){
      success(response);
    }, function(response){
      error(response);
    });

  };

  return this;

}]);


dmap.service('GoogleMaps', ['$http', 'global', function($http, $global){

  var mMap = null;

  var markers = [];

  var mMarker = null;

  var myLatlng = {lat: -30.0370096, lng: -51.2200382};

  var mMarkCallback = null;

  var mScope = null;

  var mGeocoder = null;

  this.setMarkCallback = function(callback){
    mMarkCallback = callback;
  };

  this.set = function(element, $scope){
    
    mScope = $scope;

    mGeocoder = new google.maps.Geocoder();

    mMap = new google.maps.Map(element, {
      zoom: 15,
      center: myLatlng,
      disableDefaultUI: true
    });

    mMap.addListener('rightclick', function(e){

      var latLng = e.latLng;
      addMarker(latLng);
      mMap.panTo(latLng);

      if(mMarkCallback) {
        mMarkCallback(latLng);
      }

    });

  };

  var addMarker = function(latLng){

    if(mMarker != null) {
      mMarker.setMap(null);
    }
    mMarker = new google.maps.Marker({
      position: latLng
    });

    mMarker.setMap(mMap);

  };

  this.updateLatLng = function(position) {
    var myLatlng = {
      lat: parseFloat(position.latitude), 
      lng: parseFloat(position.longitude)
    };

    addMarker(myLatlng);
    mMap.panTo(myLatlng);
    mMap.setZoom(15);

  };

  this.locateByAddress = function(address) {

    console.log("Buscando...", address);

    if(!address.number){
      alert("Informe o número");return;
    }

    if(!address.street){
      alert("Informe a rua");return;
    }

    if(!address.city){
      alert("Informe a cidade");return;
    }

    var string = address.number+', '+address.street+', '+address.city+', '+address.country;

    console.log("Mounted String", string);

    mGeocoder.geocode({
      'address': string}, 
      function(results, status){

      if(status === google.maps.GeocoderStatus.OK) {
        var location = results[0].geometry.location;
        addMarker(location);
        mMap.panTo(location);
        mMap.setZoom(15);
        mMarkCallback(location);
        alert("Local encontrado");
      } else {
        alert("Local não encontrado");
      }

    });

    return true;

  };



  return this;

}]);