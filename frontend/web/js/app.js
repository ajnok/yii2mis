/**
 * Created by ajnok on 11/10/2015 AD.
 */
var app = angular.module('test', []);

app.controller('ctrl', function ($scope) {
    $scope.data = "test data";
    $scope.fun = function () {
        console.log("ok");
    }
});