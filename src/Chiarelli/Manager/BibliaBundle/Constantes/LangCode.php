<?php

namespace Chiarelli\Manager\BibliaBundle\Constantes;

use Chiarelli\Manager\BibliaBundle\Lang\Object;
use stdClass;


class LangCode extends Object {    
    
    private static $JSON;
    private $code;
    private $name;

    private function __construct( stdClass $stdClass ) {
        
        $array = (array) $stdClass;
        
        foreach ($array as $attr => $value) {
            $this->{$attr} = $value;
        }
        
    }
    
    /**
     * 
     * @param string $code
     * @return LangCode
     */
    static function getInstanceOfCode( $code ) {
        return self::searchValueOfProp('code', $code );
    }

    static function getInstanceOfCountry( $country ) {
        return self::searchValueOfProp('name', $country);                
    }
    
    private static function searchValueOfProp( $prop, $value ) {
        $result = self::searchJson( $value, $prop );
        if( $result === FALSE )            
            return $result;
        
        return new LangCode( $result );  
    }

    private static function searchJson( $value, $prop ) {
        
        if( ! isset(self::$JSON) )
            self::$JSON = json_decode( file_get_contents( __DIR__ . '/langcode.json' ) );
        
        
        foreach ( self::$JSON as $linha ) {
            
            if( strtolower( $linha->{$prop} ) === strtolower( $value )  )                
                return $linha;
            
        }
        
        return FALSE;
    }
    
    function getCode() {
        return $this->code;
    }

    function getName() {
        return $this->name;
    }


    
    
}
