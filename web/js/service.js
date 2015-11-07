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

    postData = {};
    postData.name = data.name;

    $http.post($global.url('/places'), postData).then(function(response){
      success(response);
    }, function(response){
      error(response);
    });

  };

  return this;

}]);
