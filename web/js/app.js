var dmap = angular.module('dmap', []);

dmap.constant('global', {
  apiUrl: 'http://localhost:4058/',
  url: function(p){
    return 'http://localhost:4058' + p;
  }
});

dmap.config(['$interpolateProvider', function ($interpolateProvider) {

  $interpolateProvider.startSymbol('[[').endSymbol(']]');

}]);
