<?php

namespace Chiarelli\Manager\BibliaBundle\Exceptions;

/**
 * Description of IllegalArgumentException
 *
 * @author raphael
 */
class EnumException extends GeneralException  {
    
    public function __construct($message = '', $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
}
