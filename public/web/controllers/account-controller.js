/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('accountController', ['config', '$scope', '$http',
    function (config, $scope, $http) {
        //login the user
        var accountCtrl = this;
        accountCtrl.loginDetails = {};
        $scope.sessionToken;

        accountCtrl.login = function () {
            var request = {
                'url': config.apiUrl + 'login',
                'data': accountCtrl.loginDetails,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json'
                }
            };
            $http(request).then(function (response) {
                $scope.sessionToken = response.data;
            }), function (response) {
                console.log("problem while creating product");
                console.log(response);
            };
        }
        $scope.message = 'Look! I am an about page.';
        console.log($scope.sessionToken);
    }]);