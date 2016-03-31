var app = angular.module('app', []);

app.controller( 'painelController', function ( $scope, $http ){
    
    console.log('Iniciando controller');
    
    $scope.biblies = [];    
    $scope.optiongroups = [];
    $scope.allLangs = null;
    
    $scope.selected = {};
    $scope.selected['biblie'] = {};
    
        
    $http
        .get('/biblie-api/default_indexes')
        .success(function(data){
            
            $scope.data = data;
            
            $scope.biblies = data.biblies;
            $scope.optiongroups = prepareOptions( $scope.biblies );
        })
        .error(function(){
            alert('Erro!');
        });
            
    
    $scope.selectBiblie = function (){
        
        var selected = $('#select-biblia option:selected');        
        var biblie = getBiblieOfSigla(selected.attr('ng-value'));
        
        $scope.selected.biblie = biblie;        
    };
    
    $scope.getAllLangs = function (){
        
        if( ! $scope.allLangs ) {
            
            $http
            .get('/biblie-api/lang/all')
            .success(function(data){

                $scope.allLangs = data;

            })
            .error(function(){
                alert('Erro!');
            });
            
        }
        
    };
    
    $scope.getDescricaoOfCode = function ( code ){
        
        var name = null;
        $.each( $scope.allLangs, function ( i, v ){
            if(v.code === code){
                name = v.name;
                return ;
            }
        });
        
        return name;
    }; 
    
    
    function getBiblieOfSigla( sigla ){
        
        var biblie = {};
        $.each( $scope.biblies, function ( i, v ){
            if(v.sigla === sigla){
                biblie = v;
            }
        });
        
        return biblie;        
    }
    
    $scope.page = {};
    $scope.page.attrs = JSON.parse( $('attrs').text() );
    
    $('title').text( $scope.page.attrs.title );
    
    $scope.getAllLangs();
    
    
});



function prepareOptions( biblies ){

    var optiongroups = {};

    $.each( biblies, function ( index, element ) {

        if( ! optiongroups[element.langCode] ){
            optiongroups[element.langCode] = [];
        }

        optiongroups[element.langCode].push(element);
    });

    return optiongroups;        
};

