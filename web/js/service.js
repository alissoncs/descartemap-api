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
    console.log("PlaceService.save", data);
    $http.post($global.url('/places'), data).then(function(response){
      console.log("PlaceService.save.success", response);
      success(response);
    }, function(response){
      console.log("PlaceService.save.error", response);
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
    console.log("PlaceService.update", data);
    $http.put($global.url('/places/'+id), data).then(function(response){
      console.log("PlaceService.update.success", response);
      success(response);
    }, function(response){
      console.log("PlaceService.update.error", response);
      error(response);
    });
  };

  return this;

}]);
