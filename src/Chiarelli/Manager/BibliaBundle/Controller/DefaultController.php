<?php

namespace Chiarelli\Manager\BibliaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    
    public function indexAction()
    {       
        
        $page = json_encode([
            'title' => 'Painel Belinha',            
        ]);
        
        $html  = $this->renderView('ChiarelliManagerBibliaBundle:Default:head.html.php');
        $html .= $this->renderView('ChiarelliManagerBibliaBundle:Default:painel.html.php');
        
        $html .= "<attrs style='display:none;'>{$page}</attrs>";
        
        $html .= $this->renderView('ChiarelliManagerBibliaBundle:Default:footer.html.php');
        
        return new Response($html);
       
    }
}
