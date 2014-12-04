(function () {
    'use strict';

    function WordCtrl($location, $scope) {
        var time;

        $scope.word = 'tralala';
        $scope.started = false;

        $scope.start = function() {
            $scope.started = true;
            time = new Date().getTime();
        };

        $scope.redirect = function() {
            // post results back here
            time = new Date().getTime() - time;
            console.log(time);
            $location.path('/summary');
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('WordCtrl', ['$location', '$scope', WordCtrl]);
})();