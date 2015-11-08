var dmap = angular.module('dmap');

dmap.controller('MainController', ['$scope', 'global', '$http', 'PlacesApi',
function($scope, $global, $http, PlacesApi){

  $scope.types = {};
  $scope.place = null;
  $scope.places = {};
  $scope.loading = false;
  $scope.placeStatement = "create";
  $scope.search = {$:""};

  PlacesApi.get(function(r){
    $scope.places = r.data;
  }, function(r){});

  $http.get($global.apiUrl + 'types').then(function(response){
    if(response.status == 200) {
      $scope.types = response.data;
    }
  }, function(error){
  });


  $scope.openEdit = function(place){
    $scope.place = place;
    $scope.placeStatement = "edit";
  };
  $scope.openCreate = function(place){
    console.log(place);
    $scope.place = null;
    $scope.placeStatement = "create";
  };

  $scope.delete = function(place){

    if(!confirm("Tem certeza que deseja excluir " + place.name + "?")) {
      return;
    }

    $scope.loading = true;
    PlacesApi.delete(place.id, function(r){

      $scope.places.splice(place, 1);

      $scope.loading = false;

    }, function(r){

      $scope.loading = false;

    });

  };

  $scope.save = function(place){

    $scope.loading = true;
    PlacesApi.save(place, function(r){
      $scope.loading = false;

    }, function(r){
      $scope.loading = false;

      console.log(r);

      if(r.status == 422) {
        alert("Erro de validação. Verifique os dados");
      }

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
