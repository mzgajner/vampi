(function () {
    'use strict';

    function WordCtrl(Term, Session, $location, $route, $scope) {
        var time,
            soundEffect = new Audio('/mp3/bike.mp3');

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

        $('.progress-bar').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
            soundEffect.play();
            window.navigator.vibrate([200, 100, 200, 100, 200]);
            $(this).unbind('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
        });

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