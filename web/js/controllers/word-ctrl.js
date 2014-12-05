(function () {
    'use strict';

    function WordCtrl(Term, Session, $location, $route, $scope) {
        var time,
            soundEffect = new Audio('/mp3/bike.mp3');

        $scope.word = 'tralala';
        $scope.state = 'waiting';
        $scope.term = Term.get({
            discipline: $route.current.params.discipline,
            language: $route.current.params.language
        });

        $scope.discipline = $route.current.params.discipline;

        $scope.start = function() {
            $scope.state = 'playing';
            time = new Date().getTime();
        };

        $('.progress-bar').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
            soundEffect.play();
            window.navigator.vibrate([200, 100, 200, 100, 200]);
            $(this).unbind('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
        });

        $scope.redirect = function() {
            // post results back here
            $scope.state = 'sending';
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