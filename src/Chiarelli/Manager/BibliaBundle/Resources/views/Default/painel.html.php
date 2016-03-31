
    <div class="container" 
         ng-controller="painelController">

        <div class="row">

            <div class="col-sm-4 col-xs-12">

                <div class="form form-horizontal">

                    <div class="form-group">                        

                        <div class="col-xs-12">
                            <label>Versões da Bíblia</label>
                            <select id="select-biblia" class="form-control" ng-click="selectBiblie()">
                                <option> -- Selecione uma versao -- </option>
                                <optgroup ng-repeat="group in optiongroups" label="{{ getDescricaoOfCode(group[0].langCode) }}">
                                    <option ng-repeat="biblie in group" 
                                            ng-value="{{ biblie.sigla }}">
                                        {{ biblie.descricao }}
                                    </option>
                                </optgroup>
                            </select>                                
                        </div>

                    </div>   

                </div>

            </div>

            <div class="col-xs-12">
                <div class="caption">
                    
                    <div class="page-header">
                        <h1>Baixar bíblia</h1>
                    </div>
                    
                    <h4><b>Nome:</b> {{ selected.biblie.descricao }}
                        <small> -- sigla</small> <span class="label label-warning">{{ selected.biblie.sigla }}</span>
                    </h4>
                    
                    <label>Language:</label>
                    <label class="text-info" ng-bind="getDescricaoOfCode( selected.biblie.langCode )"></label>
                    
                </div>                    
            </div>

        </div><!-- /row -->  

    </div>


    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>        
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>

    <?php foreach ($view['assetic']->javascripts(
        array(
            '@ChiarelliManagerBibliaBundle/Resources/public/jquery/gritter/jquery.gritter.min.js',
            '@ChiarelliManagerBibliaBundle/Resources/public/project/js/angular/painelController.js',
        )
    ) as $url): ?>
        <script src="<?php echo $view->escape($url) ?>"></script>
    <?php endforeach; ?>
        
