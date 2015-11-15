var dmap = angular.module('dmap');

dmap.controller('MainController', ['$scope', 'global', '$http', 'PlacesApi', 'GoogleMaps', '$window',
function($scope, $global, $http, PlacesApi, GoogleMaps, $window){

  GoogleMaps.set(document.getElementById('map'), $scope);
  GoogleMaps.setMarkCallback(function(latLng){
     
      $scope.place.position = {};
      $scope.place.position.latitude = latLng.lat();
      $scope.place.position.longitude = latLng.lng();
      $scope.$apply();
      console.log('New Marker Position', $scope.place.position);

  });

  $scope.types = {};
  $scope.place = null;
  $scope.places = {};
  $scope.loading = false;
  $scope.placeStatement = "create";
  $scope.search = {$:""};

  PlacesApi.get(function(r){
    $scope.places = r.data;
  }, function(r){
  });

  $http.get($global.url('/types')).then(function(response){
    if(response.status == 200) {
      $scope.types = response.data;
    }
  }, function(error){
  });

  $http.get($global.url('/materials')).then(function(response){
    $scope.materials = response.data;
  }, function(error){

  });

  $scope.openEdit = function(place){
    $scope.place = place;
    $scope.placeStatement = "edit";
  };
  $scope.openCreate = function(place){
    $scope.place = {
      active: true,
      type: "ALL",
      address: {
        country: "Brasil",
        state: "RS"
      }
    };
    $scope.placeStatement = "create";
  };

  $scope.delete = function(index){

    var place = $scope.places[index];

    if(!confirm("Tem certeza que deseja excluir "+place.name+"?")) {
      return;
    }

    $scope.loading = true;
    PlacesApi.delete(place._id.$id, function(r){

      $scope.places.splice(index, 1);

      $scope.loading = false;
      alert("Item excluído com sucesso!");

    }, function(r){

      $scope.loading = false;
      alert("Erro ao tentar excluir!");

    });

  };

  $scope.save = function(place){

    $scope.loading = true;

    PlacesApi.save(place, function(r){
      $scope.places.push(place);
      $scope.loading = false;

      alert("Novo item cadastrado com sucesso!");

    }, function(r){
      $scope.loading = false;
      if(r.status == 422)
        alert("Erro de validação. Verifique os dados");
      else 
        alert("Ocorreu um erro desconhecido");
    });

  };

  $scope.update = function(place){

    $scope.loading = true;

    PlacesApi.update(place._id.$id, place, function(r){
      $scope.loading = false;
      alert("Item atualizado com sucesso!");
    }, function(r){
      $scope.loading = false;
      alert("Erro de validação. Verifique os dados");
    });

  };

  $scope.locateMap = function(){

    GoogleMaps.locateByAddress($scope.place.address);

  };

  // Escuta latitude e longitude
  $scope.$watchCollection('place.position', function(n, o){
    GoogleMaps.updateLatLng(n);
  });

}]);


dmap.controller('MapController', 
  ['$scope', 'global', '$http', 'PlacesApi', 'GoogleMaps', '$window', 
function($scope, global, $http, PlacesApi, GoogleMaps, $window){

  $scope.places = {};

  var element = document.getElementById('main-map');

  var mMap = new google.maps.Map(element, {
    center: new google.maps.LatLng(-30.029391, -51.211427),
    zoom: 8,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true
  });

  google.maps.event.trigger(mMap, 'resize');

  $scope.addMarks = function(places){

    angular.forEach(places, function(item){

      mMarker = new google.maps.Marker({
        position: {lat: item.position.latitude, lng: item.position.longitude},
        title: item.name,
        draggable: false,
        icon: {
          url: '/img/ic_mark_'+item.type.toLowerCase()+'.png'
        }
      });  
      mMarker.setMap(mMap);
    });

  };


  PlacesApi.get(function(s){

    if(s.status == 200) {
      $scope.addMarks(s.data);
    }

  }, function(e){

  });

}]);