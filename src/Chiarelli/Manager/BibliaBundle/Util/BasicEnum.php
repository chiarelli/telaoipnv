<?php

namespace Chiarelli\Manager\BibliaBundle\Util;

use ReflectionClass;
use Chiarelli\Manager\BibliaBundle\Exceptions\EnumException;

abstract class BasicEnum {
    protected $__CONST_SELECTED__ = null;

    private static $constCacheArray = NULL;

    private static function getConstants() {
        
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        
        $calledClass = get_called_class();
        if ( ! array_key_exists( $calledClass, self::$constCacheArray ) ) {
            $reflect = new ReflectionClass( $calledClass );
            self::$constCacheArray[ $calledClass ] = $reflect->getConstants();
        }
        return self::$constCacheArray[ $calledClass ];
    }

    final public static function isValidName( $name, $strict = false ) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists( $name, $constants );
        }

        $keys = array_map( 'strtolower', array_keys( $constants ) );
        return in_array( strtolower( $name ), $keys );
    }

    final public static function isValidValue( $value, $strict = true ) {
        $values = array_values( self::getConstants() );
        return in_array( $value, $values, $strict );
    }
    
    final static public function getEnumOfOrder( $index ){
        $index = (int) $index;
        
        $contantes = self::getConstants();        
        
        $clazz = get_called_class();
        
        if( $index < 0 || count($contantes) < ($index + 1) ) {
            
            throw new EnumException('índicie não encontrado em ' . $clazz );
        }
        
       
        $count = 0;
        
       
        foreach ( $contantes as $constName => $value ) {
            
            if( $count++ === $index ) {
                return $clazz::define( $constName );
            }
        }
    }
    
    final protected function setConst( $value ) {
        
        if( ! self::isValidValue( $value ) )
            throw new EnumException( 'Constante inválida' );
        
        $this->__CONST_SELECTED__ = $value;
        
    }
    
    final public function order() {
        $constants = self::getConstants();
        
        $index = 0;
        foreach ( self::getConstants() as $value ) {
            if( $value === $this->__CONST_SELECTED__ )
                return $index;
            $index++;
        }
    }
    
    
    
    
    
}