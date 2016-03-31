<?php

namespace Chiarelli\Manager\BibliaBundle\Lang;

use ReflectionObject;
use Symfony\Component\Intl\Exception\NotImplementedException;

/**
 * Description of Object
 *
 * @author raphael
 */
class Object {
    
    /**
     * Converte os atributos do objeto em um array.
     * 
     * @param boolean $propertiesParent default = false; Incluir os attributos 
     *                  dos parentes.
     * @return array
     * @throws NotImplementedException 
     */
    public function toArray ( $propertiesParent = false ) 
    { 
        $reflect = new ReflectionObject( $this );
        
        $properties = $reflect->getProperties();
        
        $map = [];
        foreach ($properties as $property) {
            //$property = new \ReflectionProperty($map, $name);
            $property->setAccessible(TRUE);
            
            $value = $property->getValue( $this );
            if  ( is_object ( $value )  && method_exists ( $value ,  'toArray' ))  { 
                $map[$property->name] = $value->toArray( $properties );
                continue;
            }
            
            $map[$property->name] = $value;
        }
        
        if ($propertiesParent) {
            throw new NotImplementedException(
            'Desculpe, $propertiesParent ainda não implementado.'
            );
        }

        return $map ; 
    }
    
}
