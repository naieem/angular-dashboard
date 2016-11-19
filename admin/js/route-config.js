var app = angular.module('myApp', ['ui.sortable', 'ngResource', "ui.router", "ui.tinymce", "ngSanitize", "ui.bootstrap", "angularUtils.directives.dirPagination"]);
app.config(function($stateProvider, $urlRouterProvider) {
    $stateProvider.state('home', {
        url: '/home',
        templateUrl: 'template/main.html',
        controller: 'HomeCtrl',
        controllerAs: 'all',
    }).state('new', {
        url: '/new',
        templateUrl: 'template/new.html',
        controller: 'NewCtrl'
    }).state('article', {
        url: '/article/:id',
        templateUrl: 'template/edit.html',
        controller: 'SingleCtrl',
        controllerAs: 'single',
    })
    $urlRouterProvider.otherwise('/home');
});
