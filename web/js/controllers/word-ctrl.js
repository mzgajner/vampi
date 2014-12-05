(function () {
    'use strict';

    function WordCtrl(Term, Session, $location, $route, $scope) {
        var time;

        $scope.word = 'tralala';
        $scope.started = false;
        $scope.term = Term.get({
            discipline: $route.current.params.discipline,
            language: $route.current.params.language
        });

        $scope.start = function() {
            $scope.started = true;
            time = new Date().getTime();
        };

        $scope.redirect = function() {
            // post results back here
            time = new Date().getTime() - time;
            Session.save({
                    time: time,
                    termId: $scope.term.id,
                    discipline: $route.current.params.discipline,
                    language: $route.current.params.language
                },
                function(response){
                    $location.path('/' + $route.current.params.language + '/summary');
            });
            
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('WordCtrl', ['Term', 'Session', '$location', '$route', '$scope', WordCtrl]);
})();