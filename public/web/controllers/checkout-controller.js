/**
 * Created by lenskart on 16/12/16.
 */
ecomApp.controller('checkoutController', ['config', '$rootScope', '$http', '$cookies', 'addToCart', 'Auth',
    function (config, $rootScope, $http, $cookies, addToCart, Auth) {
        var checkoutCtrl = this;
        checkoutCtrl.cartItems = {};
        if(!$rootScope.isCartEmpty){
            checkoutCtrl.cart = $rootScope.cart;
        }
       checkoutCtrl.removeFromCart = function(item){
           addToCart.removeItemFromCart(item);
           var index = checkoutCtrl.cart.items.indexOf(item);
           checkoutCtrl.cart.items.splice(index, 1);
       }

    }]);