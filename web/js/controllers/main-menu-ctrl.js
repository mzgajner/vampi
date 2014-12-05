(function () {
    'use strict';

    function MainMenuCtrl($location, $scope) {
        $scope.redirect = function() {
            $location.path('/language');
        }
    }

    angular.module('controllers', []) // [] instantiates controller module
           .controller('MainMenuCtrl', ['$location', '$scope', MainMenuCtrl]);
})();