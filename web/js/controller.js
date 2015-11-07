var dmap = angular.module('dmap');

dmap.controller('MainController', ['$scope', 'global', '$http', 'PlacesApi',
function($scope, $global, $http, PlacesApi){

  $scope.types = {};
  $scope.place = null;
  $scope.places = {};
  $scope.loading = false;

  PlacesApi.get(function(r){
    $scope.places = r.data;
  }, function(r){});

  $http.get($global.apiUrl + 'types').then(function(response){
    if(response.status == 200) {
      $scope.types = response.data;
    }
  }, function(error){
  });


  $scope.edit = function(place){
    $scope.place = place;
    console.log(place);
  };

  $scope.delete = function(place){

    PlacesApi.delete(place.id, function(r){
      $scope.places.splice(place, 1);
    }, function(r){

    });

  };

  $scope.save = function(place){

    PlacesApi.save(place, function(r){
    }, function(r){
    });

  };

  $scope.update = function(place){

    $scope.loading = true;
    PlacesApi.update(place.id, place, function(r){
      $scope.loading = false;
    }, function(r){
      $scope.loading = false;
    });

  };

}]);
