<?php

namespace Chiarelli\Manager\BibliaBundle\BusinessRules;

use Chiarelli\Manager\BibliaBundle\Entity\Biblia;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;

class BibliaBO {
    
    private $em;
    
    public function __construct( EntityManager $em ) {
        $this->em = $em;
    }
    
    function get( $sigla ) {
        
        try {
            
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    function load( $sigla ) {
        
    }
    
    function find( Criteria $crteria ) {
        
    }
    
    function create( Biblia $biblia ) {
        
        try {
            
            $em->persist( $biblia );
            $em->flush();
            $em->getConnection()->commit();
        } catch (Exception $e) {
            $em->getConnection()->rollBack();
            throw $e;
        }
        
    }
    
    function save( Biblia $biblia ) {
        
    }
    
    function delete( Biblia $biblia ) {
        
    }
    
    function deleteByID( $sigla ) {
        
    }
    
}
