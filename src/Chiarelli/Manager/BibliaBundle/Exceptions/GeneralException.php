<?php

namespace Chiarelli\Manager\BibliaBundle\Exceptions;

/**
 * Description of General
 *
 * @author raphael
 */
class GeneralException extends \Exception {
    
    public function __construct($message = '', $code = null, $previous = null ) {
        parent::__construct($message, $code, $previous);
    }

    
}
