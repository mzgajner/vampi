(function () {
    'use strict';

    function DisciplineCtrl($location, $route, $scope) {
        $scope.disciplines = [{
                name: 'Draw',
                id: 'draw'
            },{ 
                name: 'Show',
                id: 'show'
            },{ 
                name: 'Tell',
                id: 'tell'
        }];

        $scope.redirect = function(discipline) {
            $location.path($route.current.params.language + '/' + discipline + '/word');
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('DisciplineCtrl', ['$location', '$route', '$scope', DisciplineCtrl]);
})();