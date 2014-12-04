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

    function SessionFactory($resource)
    {
        return $resource(
            BASE_URL + '/app_dev.php/session/'
        );
    }

    angular.module('data', ['ngResource'])
        .factory('Term', ['$resource', TermFactory])
        .factory('Session', ['$resource', SessionFactory])
    ;

})();