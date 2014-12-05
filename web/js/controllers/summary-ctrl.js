(function () {
    'use strict';

    function SummaryCtrl($location, $route, $scope) {
        $scope.possibleResults = [
            'You were faster than most people.',
            'That was the best time for this word!',
            'Your result is above average.',
        ];
        $scope.randomResult = Math.floor(Math.random() * $scope.possibleResults.length);

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