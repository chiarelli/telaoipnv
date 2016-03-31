<?php

namespace Chiarelli\Manager\BibliaBundle\Controller;

use Chiarelli\Manager\BibliaBundle\Constantes\Testment;
use Chiarelli\Manager\BibliaBundle\Entity\Livro;
use Chiarelli\Manager\BibliaBundle\Resources\lib\simple_html_dom;
use Chiarelli\Manager\BibliaBundle\Util\CreateBiblieDefaultJson;
use Chiarelli\Manager\BibliaBundle\Util\UtilDOMBiblieSite;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
 

class PopularController extends Controller {
   
    /**
     * @Route("/")
     */
    public function indexAction() {
        
        
        
    }
    
    /**
     * @Route("/create_json")
     */
    public function bibliesAction() {
        
        set_time_limit(2000);
        
        $kernel = $this->get('kernel');        
        $content_html = $kernel->locateResource('@ChiarelliManagerBibliaBundle/Resources/views/Tmp/biblies_content.html');
        
        $content = file_get_contents( $content_html );
        
        $biblieDefault = new CreateBiblieDefaultJson( $content );
        
        //dump( $biblieDefault->getJson() );
        
        return new Response( $biblieDefault->getJson() );        
    }
    
    /**
     * @Route("/books")
     */
    public function booksAction() {
        
        $content = file_get_contents('/var/www/html/telaoipnv/src/Chiarelli/Manager/BibliaBundle/Resources/views/Tmp/biblies_content.html');
        
        $html = new simple_html_dom();
        $html->load($content);
        
        $books = UtilDOMBiblieSite::getAllBooks($html);
        
        //$livro = $books['biblie'][38];
        
        //dump($books);
        
        return $books;
        
    }
    
    /**
     * @Route("/chapter")
     */
    public function chapterAction() {
        
        $biblia = $this->bibliesAction()[0];
        
        $livro = new Livro();
            $livro->setCode('mt');
            $livro->setName('Mateus');
            $livro->setNumber(1);
            $livro->setTestment( Testment::define( Testment::OLD_TESTMENT ) );
            
        $biblia->addLivro($livro);
        
        UtilDOMBiblieSite::injectionAllChapter($livro);
        
        UtilDOMBiblieSite::injectionAllVersicles($livro);
        
        dump($biblia);
        
    }
    
    /**
     * 
     */
    public function popularAction() {
        
        $bibliasList = $this->bibliesAction(); 
        
        
        $em = $this->getDoctrine()->getManager();
        
        foreach ( $bibliasList as $biblia ) {
            
                //$em->persist( $biblia );
            foreach ( $this->booksAction() as $livro ) {
                
                    $biblia->addLivro( $livro );
                
                UtilDOMBiblieSite::injectionAllChapter( $livro, $biblia->getSigla() );
                
                $chapterList = $livro->getCapitulos();

                foreach ($chapterList as $chapter) {
                                        
                    UtilDOMBiblieSite::injectionAllVersicles( $chapter, $biblia->getSigla(), $livro->getCode() );
                }
                
                
            }  
                //$em->flush( $biblia );
           
          
        }
        
        dump($bibliasList);
        
    }
    
    
    /**
     * @Route("/test")
     */
    function test(){
        
        $ola = function( $belinha ){
            $this->mama = $belinha;
            echo $this->mama;
        };
        
       $ola("Mama");
        
    }
    
}
