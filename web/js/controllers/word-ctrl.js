(function () {
    'use strict';

    function WordCtrl(Term, Game, $location, $route, $scope) {
        var time;

        $scope.word = 'tralala';
        $scope.started = false;
        $scope.term = Term.get({
            discipline: $route.current.params.discipline
        });

        $scope.start = function() {
            $scope.started = true;
            time = new Date().getTime();
        };

        $scope.redirect = function() {
            // post results back here
            time = new Date().getTime() - time;
            Game.save({
                    time: time,
                    termId: $scope.term.id,
                    discipline: $route.current.params.discipline
                },
                function(response){
                    console.log(response);
                    $location.path('/summary');
            });
            
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('WordCtrl', ['Term', 'Game', '$location', '$route', '$scope', WordCtrl]);
})();