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
var latestArticles = [
  {'name' : 'This is to add another one'},
  {'name' : 'Lorem ipsum dolor sit amet'}
];

/* the sidebar controller*/
myApp.controller('SidebarController', function($scope) {
  $scope.sideBarArticles = latestArticles;
});