/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('registerController', ['config', '$scope', '$http','$window', '$rootScope', 'Auth',
    function (config, $scope, $http, $window, $rootScope,Auth) {
     var registerCtrl = this;
     registerCtrl.userDetails= {};

     registerCtrl.signup=function(){
         var request = {
             'url': config.apiUrl + 'user',
             'data': registerCtrl.userDetails,
             'method': 'post',
             'headers': {
                 'Content-Type': 'application/json'
             }
         };
         $http(request).then(function (response) {
             registerCtrl.userDetails= {};
             $window.location.href = '#!/account';
         }), function (response) {
         };
     }
}]);