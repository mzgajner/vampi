(function () {
    'use strict';

    var BASE_URL = '';

    function EntityFactory($resource)
    {
        return $resource(
            BASE_URL + '/:entityType/:id', {
                entityType: '@entityType',
                id: '@id',
                size: 1000
            }, {
                query: {
                    isArray: true
                }
            }
        );
    }

    angular.module('data', ['ngResource'])
        .factory('Entity', ['$resource', EntityFactory])
    ;

})();