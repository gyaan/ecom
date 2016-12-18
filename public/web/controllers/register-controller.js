/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('registerController', ['config', '$scope', '$http',
    function (config, $scope, $http) {
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
             console.log(response);
         }), function (response) {
             console.log("problem while creating product");
             console.log(response);
         };
         console.log(registerCtrl.userDetails);
     }
}]);