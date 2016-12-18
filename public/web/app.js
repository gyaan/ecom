/**
 * Created by lenskart on 14/12/16.
 */
// create the module and name it ecomApp
var ecomApp = angular.module('ecomApp', ["ngRoute"]);

// configure our routes
ecomApp.config(function ($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl: 'pages/home.html',
            controller: 'mainController'
        })

        // route for the about page
        .when('/account', {
            templateUrl: 'pages/account.html',
            controller: 'accountController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl: 'pages/contact.html',
            controller: 'contactController'
        })
        //route for the checkout page
        .when('/checkout', {
            templateUrl: 'pages/checkout.html',
            controller: 'checkoutController'
        })

        //route for the checkout page
        .when('/products', {
            templateUrl: 'pages/products.html',
            controller: 'productsController'
        })

        //route for the checkout page
        .when('/register', {
            templateUrl: 'pages/register.html',
            controller: 'registerController'
        })

        //route for the checkout page
        .when('/single', {
            templateUrl: 'pages/single.html',
            controller: 'singleController'
        })

        .when('/admin/users', {
            templateUrl: 'pages/admin/users.html',
            controller: 'usersController'
        })
        .when('/admin/products', {
            templateUrl: 'pages/admin/products.html',
            controller: 'productsController'
        })

});

ecomApp.constant('config', {
    apiUrl: 'http://local.ecom/api/v1/',
});











