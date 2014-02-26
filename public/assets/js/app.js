/*defining the application*/
var myApp = angular.module('myApp', []);

/*app configuration added here*/
myApp.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('{[');
  $interpolateProvider.endSymbol(']}');
});

/* the blog page controller*/
myApp.controller('BlogController', function($scope) {
  $scope.pageTitle = "Welcome to Learning Laravel 4 Blog page";
});