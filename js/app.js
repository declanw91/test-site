var app = angular.module('myBlogs', []);
app.config(['$sceProvider', function($sceProvider) {
    $sceProvider.enabled(false);
}]);