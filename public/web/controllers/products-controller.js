/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('productsController',['config', '$rootScope', '$http','Auth',
    function (config, $rootScope, $http, Auth){

        var productCtrl = this;
        //existing products
        productCtrl.product = {}; //new product need to create
        productCtrl.existingProduct;
        var request = {
            'url': config.apiUrl + 'product',
            'method': 'get',
            'headers':{
                'Authorization':'Bearer '+$rootScope.token,
            }
        };
        $http(request).then(function (response) {
            console.log(response.data);
            productCtrl.existingProduct = response.data;
        }), function (response) {
            console.log("some problem in getting product details");
        }


        productCtrl.addProduct = function () {
            var request = {
                'url': config.apiUrl + 'product',
                'data': productCtrl.product,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json',
                    'Authorization':'Bearer '+$rootScope.token,
                }
            };
            $http(request).then(function (response) {
                productCtrl.existingProduct.push(response.data);
                productCtrl.product = {};
            }), function (response) {
                console.log("problem while creating product");
                console.log(response);
            };
        };

        productCtrl.deleteProduct = function (product) {
            var request = {
                'url': config.apiUrl + 'product/' + product.id,
                'method': 'delete',
                'headers':{
                    'Authorization':'Bearer '+$rootScope.token,
                }
            }
            $http(request).then(function (response) {

                //if product got delete form the server
                productCtrl.removeUser(product);
            }), function (response) {
                console.log(response);
            };
        }

        productCtrl.removeUser = function (item) {
            var index = productCtrl.existingProduct.indexOf(item);
            productCtrl.existingProduct.splice(index, 1);
        }

        /*  productCtrl.confirmation = function(){  //todo complete this option and add before delete

         }
         */

        console.log(productCtrl.existingProduct)
}]);