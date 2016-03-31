<?php

namespace Chiarelli\Manager\BibliaBundle\Controller;

use Chiarelli\Manager\BibliaBundle\Constantes\LangCode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
 

class APIController extends Controller {
   
    /**
     * @Route("/")
     */
    public function indexAction() {
        
        return new Response('API on');
        
    }
    
    /**
     * @Route("/default_indexes")
     * 
     * @return Response
     */
    function allBiblies() {
        
        $kernel = $this->get('kernel');        
        $filename = $kernel
                ->locateResource('@ChiarelliManagerBibliaBundle/Resources/'
                        . 'public/project/json/biblies_default.json');
        
        $contents = file_get_contents($filename);
        
        return new Response($contents);
        
    }
    
    /**
     * @Route("/lang/description")
     */
    function langForCodeAction(Request $request ) {
        
        $code = $request->query->get('code');
        
        $lang = LangCode::getInstanceOfCode($code);
        
        $content = '';
        if( $lang === \FALSE ){
            
            $error = [
                'type'  => 'warning',
                'msg'   => 'O Código não corresponde a nenhuma linguagem.',
                'code'  => 'notLangForCode',
            ];
            
            $content = $error;
        } else {
            
            $content = $lang->toArray();
            unset( $content['JSON'] );
        }
        
        
        return new Response( json_encode( $content ) );
        
    }
    
    /**
     * @Route("/lang/all")
     */
    function allLangsAction(Request $request ) {
        
        $kernel = $this->get('kernel');        
        $filename = $kernel
                ->locateResource('@ChiarelliManagerBibliaBundle/Resources/'
                        . 'public/project/json/langcode.json');
        
        $contents = file_get_contents($filename);
        
        return new Response($contents);
        
    }
    
    
    
}
