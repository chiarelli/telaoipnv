<?php

namespace Chiarelli\Manager\BibliaBundle\Constantes;

use Chiarelli\Manager\BibliaBundle\Util\BasicEnum;


class Testment extends BasicEnum {
   
    const OLD_TESTMENT = 'OLD_TESTMENT';
    
    const NEW_TESTMENT = 'NEW_TESTMENT';
    
    private function __construct( $value ) {
        parent::setConst( $value );
    }
    
    static function define( $const ) {
        return new Testment( $const );                
    }
    
    function getValue() {
        return $this->__CONST_SELECTED__;
    }
    
}
