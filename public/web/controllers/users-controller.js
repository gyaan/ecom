/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('usersController', ['config', '$scope', '$http',
    function (config, $scope, $http) {
        var userCtrl = this;
        //existing users
        userCtrl.user = {}; //new user need to create
        userCtrl.existingUser;
        var request = {
            'url': config.apiUrl + 'user',
            'method': 'get',
        };
        $http(request).then(function (response) {
            console.log(response.data);
            userCtrl.existingUser = response.data;
        }), function (response) {
            console.log("some problem in getting user details");
        }


        userCtrl.createUser = function () {
            var request = {
                'url': config.apiUrl + 'user',
                'data': userCtrl.user,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json'
                }
            };
            $http(request).then(function (response) {
                userCtrl.existingUser.push(response.data);
                userCtrl.user = {};
            }), function (response) {
                console.log("problem while creating user");
                console.log(response);
            };
        };

        userCtrl.deleteUser = function (user) {
            var request = {
                'url': config.apiUrl + 'user/' + user.id,
                'method': 'delete',
            }
            $http(request).then(function (response) {

                //if user got delete form the server
                userCtrl.removeUser(user);
            }), function (response) {
                console.log(response);
            };
        }

        userCtrl.removeUser = function (item) {
            var index = userCtrl.existingUser.indexOf(item);
            userCtrl.existingUser.splice(index, 1);
        }

      /*  userCtrl.confirmation = function(){  //todo complete this option and add before delete

        }
        */

        //console.log(config);
        //$scope.message = 'Contact us! JK. This is just a demo.';
        console.log(userCtrl.existingUser)

    }]);