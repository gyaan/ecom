/**
 * Created by lenskart on 18/12/16.
 */
/**
 * Created by lenskart on 18/12/16.
 */
ecomApp.service('Auth', function ($http,$cookies) {
    this.user={};
    this.setUser = function (user) {
        this.user = user;
    }
    this.getUser = function () {
        return this.user;
    }
    this.isLoggedIn = function () {
        console.log(this.user);
        return Object.keys(this.user).length >0 ? true : false;
    }
    this.isAdmin = function () {
        console.log(this.user);
        return this.isLoggedIn() && this.user.is_admin == 1 ? true : false;
    }
});