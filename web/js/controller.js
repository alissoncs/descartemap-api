var dmap = angular.module('dmap');

dmap.controller('MainController', ['$scope', 'global', '$http', 'PlacesApi',
function($scope, $global, $http, PlacesApi){

  PlacesApi.get(function(r){
    $scope.places = r.data;
  }, function(r){});

  $scope.types = {};
  $http.get($global.apiUrl + 'types').then(function(response){
    if(response.status == 200) {
      $scope.types = response.data;
    }
  }, function(error){
  });

  $scope.place = {};

  $scope.edit = function(place){
    $scope.place = place;
    console.log(place);
  };

  $scope.save = function(place){

    PlacesApi.save(place, function(r){
      console.log(r);
    }, function(r){
      console.log(r);
    });

  };

}]);
