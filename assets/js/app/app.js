var app = angular.module('angular',['ngRoute'])
app.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/', {
      controller: 'HomeCtrl as home',
      templateUrl: '/partials/home/index.html'
    })
    .when('/vedomost', {
      controller: 'VedomostCtrl as vedomost',
      templateUrl: '/partials/vedomost/index.html'
    })
    .when('/students', {
      controller: 'StudentsCtrl as students',
      templateUrl: '/partials/students/index.html'
    })
    .when('/teachers', {
      controller: 'TeachersCtrl as teachers',
      templateUrl: '/partials/teachers/index.html'
    })
    .when('/pred', {
      controller: 'PredCtrl as pred',
      templateUrl: '/partials/pred/index.html'
    })
    .otherwise({
      redirectTo: '/'
    })
}]);

app.run(['$rootScope', function($rootScope){
  _.mixin(s.exports());
  $rootScope._ = _;
}])

app.controller('HomeCtrl', ['$scope', '$rootScope', function($scope, $rootScope){
  $rootScope.currentPage = 'home';
}]);

app.controller('VedomostCtrl', ['$scope', '$rootScope', function($scope, $rootScope){
  $rootScope.currentPage = 'vedomost';
}]);

app.controller('ProfileCtrl', ['$scope', '$rootScope', function($scope, $rootScope){
  $rootScope.currentPage = 'profile';
}]);