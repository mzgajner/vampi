(function () {
    'use strict';

    function confirm($modal, $rootScope, $q) {
        var scope = $rootScope.$new();
        var deferred;
        scope.title = 'Confirmation';
        scope.content = 'Are you sure?';
        scope.answer = function(res) {
            deferred.resolve(res);
            confirm.hide();
        };
      
        var confirm = $modal({
            template: 'partials/confirm.tpl.html',
            scope: scope,
            show: false,
            html: true
        });

        var parentShow = confirm.show;
        confirm.show = function() {
            deferred = $q.defer();
            parentShow();
            return deferred.promise;
        };
      
        return confirm;
    }

    function saveas($modal, $rootScope, $q) {
        var scope = $rootScope.$new();
        var deferred;
        scope.title = 'Save filter As';
        //scope.content = 'Filter name';
        scope.answer = function(res, name) {
            deferred.resolve({ answer: res, name: name });
            saveas.hide();
        };

        scope.filterName = 'New Filter';
      
        var saveas = $modal({
            template: 'partials/save-as.tpl.html',
            scope: scope,
            show: false,
            html: true
        });

        var parentShow = saveas.show;
        saveas.show = function() {
            deferred = $q.defer();
            parentShow();
            return deferred.promise;
        };
      
        return saveas;
    }

    function pickType(Entity, $modal, $rootScope, $q, $location, $filter) {
        return function(entityType, parentId) {
            // Get template type (e.g. change productconfigs to products)
            var templateType = entityType.replace('config','');
            var scope = $rootScope.$new();

            scope.entities = Entity.query({ 
                entityType: templateType
            });

            scope.save = function(id){
                modal.hide();
                $location.path('/' + entityType + '/detail')
                         .search({
                            'templateId' : id,
                            'parentId' : parentId
                         });
            };

            scope.title = 'Create new ' +  $filter('singularize')(entityType);
            scope.content = 'Pick:';
          
            var modal = $modal({
                template: 'partials/new-system.tpl.html',
                scope: scope,
                show: false,
                html: true
            });
      
            return modal;
        };
    }

    function showAlert($alert) {
        return function(type, message) {
            var alert = $alert({
                content: message,
                type: type,
            });
            alert.$promise.then(alert.show);
        }
    }

    function alertFromUrl(showAlert, $route, $location) {
        return function() {
            if($route.current.params.alertMsg) {
                showAlert('success', $route.current.params.alertMsg);
                $location.search({});
            }
        }
    }

    function updateObject() {
        return function(oldObj, newObj) {
            var oldProperties = oldObj.properties;
            var newProperties = newObj.properties;

            oldObj = newObj;
            oldObj.properties = oldProperties;

            // Loop through config properties and assign values
            for(var i = 0; i < oldObj.properties.length; i++) {
                for(var j = 0; j < newProperties.length; j++) {
                    if(oldObj.properties[i].name === newProperties[j].name) {
                        oldObj.properties[i].value = newProperties[j].value;
                    }
                }
            }

            return newObj;
        }
    }

    angular.module('services', [])
        .service('confirm', ['$modal', '$rootScope', '$q', confirm])
        .service('saveas', ['$modal', '$rootScope', '$q', saveas])
        .service('pickType', ['Entity', '$modal', '$rootScope', '$q', '$location', '$filter', pickType])
        .service('showAlert', ['$alert', showAlert])
        .service('alertFromUrl', ['showAlert', '$route', '$location', alertFromUrl])
        .service('updateObject', updateObject)
    ;
})();