<?php

namespace Chiarelli\Manager\BibliaBundle\Util;

use Chiarelli\Manager\BibliaBundle\Resources\lib\simple_html_dom;

class ConnectBiblia {
            
    static function getSiteDOM( $codeBiblie = null, $codeBook = null, $indexCapitulo = null ){
        
        static $count = 0;
        
        try {
            
            $codeBiblie = $codeBiblie ? '/' . urlencode( $codeBiblie ): '';
            $codeBook = $codeBook ? '/' . urlencode( $codeBook ) : '';
            $indexCapitulo = $indexCapitulo ? '/' . urlencode( $indexCapitulo ) : '';
            
            $content = file_get_contents("https://www.bibliaonline.com.br{$codeBiblie}{$codeBook}{$indexCapitulo}");


            $html = new simple_html_dom();        

                $html->load( $content );
                
            $count = 0;
            
            return $html;
            
        } catch (\Exception $exc) {        
            
            sleep(4);
            
            if( $count++ > 3 ){
                throw new $exc;
            }
            
            return self::getSiteDOM($codeBiblie, $codeBook, $indexCapitulo);
            
        }
        
    }
    
    
    
    
}
