/**
 * Created by lenskart on 16/12/16.
 */
// create the controller and inject Angular's $scope
ecomApp.controller('mainController', ['config', '$scope', '$http',
    function (config, $scope, $http) {

        var mainCtrl = this;

        //define variable needed for pront page
        mainCtrl.latestProducts;
        mainCtrl.latestFeaturedProduct;

        var request = {
            'url': config.apiUrl + 'product/latest',
            'method': 'get',
        };
        $http(request).then(function (response) {
            console.log(response.data);
            mainCtrl.latestProducts = response.data;
        }), function (response) {
            console.log("some problem in getting user details");
        }

        var request = {
            'url': config.apiUrl + 'product/featured',
            'method': 'get',
        };
        $http(request).then(function (response) {
            console.log(response.data);
            mainCtrl.latestFeaturedProduct = response.data[0]; //as of now only one product
        }), function (response) {
            console.log("some problem in getting user details");
        }

        console.log(mainCtrl.latestProducts);
        console.log(mainCtrl.latestFeaturedProduct);

    }]);
