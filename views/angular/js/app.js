(function(){
    libraries_url = 'http://192.168.1.200/views/angular/';
    require()
    var app = angular.module('store',['panelsMod','productsMod']);
    
    app.controller('StoreController',function(){
       this.products = productsMod.gems
    });
    
    app.controller('ReviewController',function(){
        this.review = {};
        this.addReview = function(reviewProduct){
            reviewProduct.reviews.push(this.review);
            this.review = {};
        };
    });
    

    

})();

