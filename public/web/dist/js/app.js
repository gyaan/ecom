/*
 e-com 2016-12-19 
*/
var ecomApp=angular.module("ecomApp",["ngRoute","ngCookies"]).run(function(a,b,c,d,e,f){b.isCartEmpty=f.isCartEmpty(),b.totalCartItem=f.totalItemInTheCart(),b.totalCartAmount=f.totalAmount(),b.cart=f.getCart(),void 0!=b.user&&"{}"!=b.user&&(b.isLoggedIn=!0,console.log(b.user),b.user=c.getObject("userDetails"),1==b.user.is_admin&&(b.isAdmin=!0),f.getExistingCart()),b.logout=function(){c.remove("userDetails"),c.remove("token"),b.isLoggedIn=!1,b.isAdmin=!1,c.remove("cart"),b.isCartEmpty=f.isCartEmpty(),b.totalCartItem=f.totalItemInTheCart(),b.totalCartAmount=f.totalAmount(),b.cart=f.getCart()},b.addToCart=function(a){console.log(a),f.addItemToCart(a)}});ecomApp.config(function(a){a.when("/",{templateUrl:"pages/home.html",controller:"mainController"}).when("/account",{templateUrl:"pages/account.html",controller:"accountController"}).when("/contact",{templateUrl:"pages/contact.html",controller:"contactController"}).when("/checkout",{templateUrl:"pages/checkout.html",controller:"checkoutController"}).when("/products",{templateUrl:"pages/products.html",controller:"productsController"}).when("/register",{templateUrl:"pages/register.html",controller:"registerController"}).when("/single",{templateUrl:"pages/single.html",controller:"singleController"}).when("/admin/users",{templateUrl:"pages/admin/users.html",controller:"usersController"}).when("/admin/products",{templateUrl:"pages/admin/products.html",controller:"productsController"})}),ecomApp.constant("config",{apiUrl:"http://local.ecom/api/v1/"});