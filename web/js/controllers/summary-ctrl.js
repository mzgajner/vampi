(function () {
    'use strict';

    function SummaryCtrl($location, $scope) {
        $scope.quit = function() {
            $location.path('/main-menu');
        };

        $scope.replay = function() {
            $location.path('/discipline');
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('SummaryCtrl', ['$location', '$scope', SummaryCtrl]);
})();