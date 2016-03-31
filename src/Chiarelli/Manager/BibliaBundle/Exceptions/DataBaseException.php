<?php

namespace Chiarelli\Manager\BibliaBundle\Exceptions;
/**
 * Description of DataBaseException
 *
 * @author raphael
 */
class DataBaseException extends GeneralException  {
    
    public function __construct( $message = '', $code = null, $previous = null ) {
        parent::__construct($message, $code, $previous);
    }
    
}