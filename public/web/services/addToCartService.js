/**
 * Created by lenskart on 18/12/16.
 */
ecomApp.service('addToCart', function (config,$cookies, $http, $rootScope) {

    this.getCart = function () {
        return $cookies.getObject('cart');
    }

    this.addItemToCart = function (item) {
        var cart = {
            'items': [],
            'totalItems': 0,
            'totalAmount': 0
        };
        var cartDetails = $cookies.getObject('cart');
        if (cartDetails != undefined) {
            cart = cartDetails;
        }

        //check if item is already present in the cart
        //then just increase the count

        cart.items.push(item);
        cart.totalItems++;
        cart.totalAmount = cart.totalAmount + item.selling_price;
        $cookies.putObject('cart', cart);

        $rootScope.totalCartItem = cart.totalItems;
        $rootScope.totalCartAmount = cart.totalAmount;
        $rootScope.isCartEmpty = false;
        $rootScope.cart = cart;

        //if user is loggedin then do http and add the item to cart
        this.addItemToCartForLoggedInUser(item);
    }

    this.totalItemInTheCart = function () {
        if ($cookies.getObject('cart') == undefined)
            return 0;
        return $cookies.getObject('cart').totalItems;
    }

    this.totalAmount = function () {
        if ($cookies.getObject('cart') == undefined)
            return 0
        return $cookies.getObject('cart').totalAmount;
    }

    this.isCartEmpty = function () {
        if ($cookies.getObject('cart') == undefined)
            return true;
        return this.totalItemInTheCart() == 0;
    }

    this.removeItemFromCart = function (item) {

        var cartDetails = $cookies.getObject('cart');
        var index = cartDetails.items.indexOf(item);
        cartDetails.totalItems--;
        cartDetails.totalAmount = cartDetails.totalAmount - item.selling_price;
        cartDetails.items.splice(index, 1);

        $cookies.putObject('cart', cartDetails);
        $rootScope.totalCartItem = cartDetails.totalItems;
        $rootScope.totalCartAmount = cartDetails.totalAmount;
        $rootScope.cart = cartDetails;

        if (cartDetails.totalItems == 0) {
            $rootScope.isCartEmpty = true;
        }
        this.removeItemFromCartForLoggedInUser(item)

    }

    this.addItemToCartForLoggedInUser = function (item) {

        if ($rootScope.isLoggedIn) {
            data = {
                'product_id': item.id,
                'product_quantity': 1, //lets alway adding one item
                'user_id': $rootScope.user.id,
            };
            var request = {
                'url': config.apiUrl + 'cart',
                'data': data,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json'
                }
            };
            $http(request).then(function (response) {
                console.log("item added to the cart");
            }), function (response) {
                console.log("problem while adding item to the cart");
            };
        }
    }

    this.removeItemFromCartForLoggedInUser = function (item) {
        if ($rootScope.isLoggedIn) {
            data = {
                'product_id': item.id,
                'user_id': $rootScope.user.id,
            };
            var request = {
                'url': config.apiUrl + 'cart/remove',
                'data': data,
                'method': 'post',
                'headers': {
                    'Content-Type': 'application/json'
                }
            };
            $http(request).then(function (response) {
                console.log("item delete from the cart");
            }), function (response) {
                console.log("problem while adding item to the cart");
            };
        }
    }

    this.getExistingCart = function(){
        if ($rootScope.isLoggedIn) {
            var request = {
                'url': config.apiUrl + 'user/cart/'+$rootScope.user.id,
                'method': 'get',
            };
            $http(request).then(function (response) {
                console.log(response.data);
                $cookies.putObject('cart',response.data);
                $rootScope.isCartEmpty=this.isCartEmpty();
                $rootScope.totalCartItem=this.totalItemInTheCart();
                $rootScope.totalCartAmount=this.totalAmount();;
                $rootScope.cart=this.getCart();

            }), function (response) {
                console.log("some problem in getting product details");
            }

        }
    }

});