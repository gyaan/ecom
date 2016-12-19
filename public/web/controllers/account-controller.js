/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('accountController', ['config', '$rootScope', '$http', '$window','$cookies', 'Auth','addToCart',
    function (config, $rootScope, $http,$window,$cookies,Auth,addToCart) {
        //login the user
        var accountCtrl = this;
        accountCtrl.loginDetails = {};
        accountCtrl.errorMessage = '';
        accountCtrl.login = function () {
            var request = {
                'url': config.apiUrl + 'login',
                'data': accountCtrl.loginDetails,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json',

                }
            };
            $http(request).then(function (response) {

                if(typeof response.data == 'object'){
                $rootScope.user=response.data;
                $rootScope.isLoggedIn=true;
                $cookies.put('token',$rootScope.user.token);
                $cookies.putObject('userDetails',response.data);
                addToCart.getExistingCart();
                $window.location.href = '#!/';
                }
                else{
                    accountCtrl.errorMessage = response.data;
                }
            }), function (response) {
                console.log("problem while creating product");
                console.log(response);
            };
        }
    }]);