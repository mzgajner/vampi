(function () {
    'use strict';

    function LanguageCtrl($location, $scope) {
        $scope.languages = [{
                name: 'English',
                id: 'en'
            },{ 
                name: 'German',
                id: 'de'
            },{ 
                name: 'Slovenian',
                id: 'sl'
        }];

        $scope.redirect = function(language) {
            $location.path(language + '/discipline');
        };
    }

    angular.module('controllers') // [] instantiates controller module
           .controller('LanguageCtrl', ['$location', '$scope', LanguageCtrl]);
})();