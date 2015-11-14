(function(){
    app = angular.module('panelsMod',[]);
    libraries_url = 'http://192.168.1.200/views/angular/';
    
    panelsHtml = [
        {
            name: "Product",
            src: libraries_url + "html/panel_description.html"
        },
        {
            name: "Specifications",
            src: libraries_url + "html/panel_specifications.html"
        },
        {
            name: "Reviews",
            src: libraries_url + "html/panel_reviews.html"
        }
    ];
    app.directive('productPanels', function(){
        return {
            restrict: 'E',
            templateUrl: libraries_url + 'html/panels.html',
            controller: function(){
                this.tab = 1;
                this.panelsHtml = panelsHtml;
                this.selectTab = function(setTab){
                    this.tab = setTab;
                }
                this.isSelected = function(checkTab){
                    return this.tab === checkTab;
                }
            },
            controllerAs: 'panels'
        }
    });
});