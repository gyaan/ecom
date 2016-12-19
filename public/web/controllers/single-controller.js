/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('singleController',['config', '$scope', '$http','addToCart','Auth',
    function (config, $scope, $http,addToCart,Auth) {
    $scope.message = 'Contact us! JK. This is just a demo.';
}]);