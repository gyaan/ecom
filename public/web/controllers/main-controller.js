/**
 * Created by lenskart on 16/12/16.
 */
// create the controller and inject Angular's $scope
ecomApp.controller('mainController', ['config', '$rootScope', '$http', 'Auth', 'addToCart',
    function (config, $rootScope, $http, Auth, addToCart) {

        var mainCtrl = this;
        //define variable needed for pront page
        mainCtrl.latestProducts;
        mainCtrl.latestFeaturedProduct;

        var request = {
            'url': config.apiUrl + 'product/latest',
            'method': 'get',
            'headers':{
                'Authorization':'Bearer '+$rootScope.token,
            }
        };
        $http(request).then(function (response) {
            mainCtrl.latestProducts = response.data;
        }), function (response) {
            console.log("some problem in getting user details");
        }

        var request = {
            'url': config.apiUrl + 'product/featured',
            'method': 'get',
            'headers':{
                'Authorization':'Bearer '+$rootScope.token,
            }
        };
        $http(request).then(function (response) {
            mainCtrl.latestFeaturedProduct = response.data[0]; //as of now only one product
        }), function (response) {
            console.log("some problem in getting user details");
        }

    }]);
