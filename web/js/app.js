(function () {
    'use strict';

    function config($routeProvider, $locationProvider) {
        var TEMPLATES_PATH = '/html'

        $routeProvider
            .when('/main-menu', {
                templateUrl: TEMPLATES_PATH  + '/main-menu.html',
                controller: 'MainMenuCtrl',
                // reloadOnSearch: false
            })
            .when('/discipline', {
                templateUrl: TEMPLATES_PATH  + '/discipline.html',
                controller: 'DisciplineCtrl',
            })
            .when('/word/:discipline', {
                templateUrl: TEMPLATES_PATH  + '/word.html',
                controller: 'WordCtrl',
            })
            .when('/summary/', {
                templateUrl: TEMPLATES_PATH  + '/summary.html',
                controller: 'SummaryCtrl',
            })
            .otherwise({
                redirectTo: '/main-menu'
            })
        ;

        $locationProvider
            // .html5Mode(false),
            .hashPrefix('!')
        ;
    }

    angular.module('app', [
        'ngRoute',
        'ngAnimate',
        'ngSanitize',
        'controllers',
        'data',
        'filters',
        'services'
    ])
    .config([
        '$routeProvider',
        '$locationProvider',
        config
    ])
})();