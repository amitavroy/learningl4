var latestArticles = [
  {'name' : 'This is to add another one'},
  {'name' : 'Lorem ipsum dolor sit amet'}
];

/* the sidebar controller*/
myApp.controller('SidebarController', function($scope) {
  $scope.sideBarArticles = latestArticles;
});