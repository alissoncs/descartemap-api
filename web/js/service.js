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

  var map = null;

  this.set = function(map){

    map = map;

  };

  this.goTo = function(lat, lng) {

    

  };

  return this;

}]);