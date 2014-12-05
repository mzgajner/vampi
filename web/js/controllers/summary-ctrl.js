(function () {
    'use strict';

    function SummaryCtrl($location, $route, $scope) {
        $scope.quit = function() {
            $location.path('/main-menu');
        };

        $scope.replay = function() {
            $location.path($route.current.params.language + '/discipline');
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('SummaryCtrl', ['$location', '$route', '$scope', SummaryCtrl]);
})();