(function(){
    app = angular.module('productsMod',[]);
    libraries_url = 'http://192.168.1.200/views/angular/';
    

    var gems = [
        {
            name: 'Dodecahedron',
            price: 2.00,
            description: '...',
            canPurchase: true,
            soldOut: false,
            images:[
                {
                    full: 'dodecahedron-01-full.jpg',
                    thumb: 'dodecahedron-01-thump.jpg'
                },
                {
                    full: 'dodecahedron-02-full.jpg',
                    thumb: 'dodecahedron-02-thump.jpg'
                },
                {
                    full: 'dodecahedron-03-full.jpg',
                    thumb: 'dodecahedron-03-thump.jpg'
                }                    
            ],
            reviews: [
                {
                    stars: 5,
                    body: "I love this product!",
                    author: "joe@thomas.com"
                },
                {
                    stars: 1,
                    body: "This product sucks",
                    author: "tim@hater.com"
                }
            ]
        },
        {
            name: 'Pentagonal',
            price: 5.95,
            description: '...',
            canPurchase: false,
            images: [],
            reviews: []
        }
    ];

    app.directive('productTitle',function(){
       return {
           restrict: 'E',
           templateUrl: libraries_url + 'html/product-title.html'
       }; 
    });
 });