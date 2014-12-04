(function () {
    'use strict';

    function DisciplineCtrl($location, $scope) {
        $scope.disciplines = [
            { name: 'draw'},
            { name: 'show'},
            { name: 'tell'},
        ];

        $scope.redirect = function(discipline) {
            $location.path('/word/' + discipline);
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('DisciplineCtrl', ['$location', '$scope', DisciplineCtrl]);
})();