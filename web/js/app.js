var dmap = angular.module('dmap', []);

dmap.constant('global', {
  apiUrl: 'http://localhost:4058/',
  url: function(p){
    return 'http://localhost:4058' + p;
  },
  mapsApi: 'AIzaSyBMc2jGxgZ4LV-HTuU_m2ljhuYINIIVx3w'
});

dmap.config(['$interpolateProvider', function ($interpolateProvider) {

  $interpolateProvider.startSymbol('[[').endSymbol(']]');

}]);
