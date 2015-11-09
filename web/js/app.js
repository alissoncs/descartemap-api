var dmap = angular.module('dmap', []);

dmap.constant('global', {
  url: function(p){
    return 'http://93.188.167.142' + p;
  },
  mapsApi: 'AIzaSyBMc2jGxgZ4LV-HTuU_m2ljhuYINIIVx3w'
});

dmap.config(['$interpolateProvider', function ($interpolateProvider) {

  $interpolateProvider.startSymbol('[[').endSymbol(']]');

}]);
