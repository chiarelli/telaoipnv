<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
                
        <?php foreach ($view['assetic']->stylesheets(
            array(
                '@ChiarelliManagerBibliaBundle/Resources/public/project/css/estilo.css',
                '@ChiarelliManagerBibliaBundle/Resources/public/jquery/gritter/jquery.gritter.css',
            ),
            array('cssrewrite')
        ) as $url): ?>
            <link rel="stylesheet" href="<?php echo $view->escape($url) ?>" />
        <?php endforeach ?>
    </head>
    
<?php echo '<body>'; ?>