<?php

namespace Chiarelli\Manager\BibliaBundle\Exceptions;

/**
 * Description of StateException
 *
 * @author raphael
 */
class StateException extends GeneralException  {
    
    public function __construct($message = '', $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
}
