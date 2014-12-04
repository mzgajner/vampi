(function () {
    'use strict';

    var BASE_URL = '';

    function TermFactory($resource)
    {
        return $resource(
            BASE_URL + '/app_dev.php/term/:discipline', {
                discipline: '@discipline'
            }
        );
    }

    function GameFactory($resource)
    {
        return $resource(
            BASE_URL + '/app_dev.php/game/'
        );
    }

    angular.module('data', ['ngResource'])
        .factory('Term', ['$resource', TermFactory])
        .factory('Game', ['$resource', GameFactory])
    ;

})();