<?php

namespace Chiarelli\Manager\BibliaBundle\Entity;

use Chiarelli\Manager\BibliaBundle\Constantes\Testment;
use Chiarelli\Manager\BibliaBundle\Lang\Object;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as Collection2;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * Livro
 */
class Livro extends Object
{
    
    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $testmentEnumIndex;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Collection2
     */
    private $capitulos;

    /**
     * @var Biblia
     */
    private $biblia;
    
    /**********************************************************************/
    public function __construct()
    {
        $this->capitulos = new ArrayCollection();
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Livro
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Livro
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set testmentEnum
     *
     * @param Testment $testmentEnum
     *
     * @return Livro
     */
    public function setTestment(Testment $testmentEnum)
    {
        $this->testmentEnumIndex = $testmentEnum->order();

        return $this;
    }

    /**
     * Get testmentEnum
     *
     * @return Testment
     */
    public function getTestment()
    {
        return Testment::getEnumOfOrder( $this->testmentEnumIndex );
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add capitulo
     *
     * @param Capitulo $capitulo
     *
     * @return Livro
     */
    public function addCapitulo(Capitulo $capitulo)
    {
        $this->capitulos[] = $capitulo;

        return $this;
    }

    /**
     * Remove capitulo
     *
     * @param Capitulo $capitulo
     */
    public function removeCapitulo(Capitulo $capitulo)
    {
        $this->capitulos->removeElement($capitulo);
    }

    /**
     * Get capitulos
     *
     * @return Collection
     */
    public function getCapitulos()
    {
        return $this->capitulos;
    }

    /**
     * Set biblia
     *
     * @param Biblia $biblia
     *
     * @return Livro
     */
    public function setBiblia(Biblia $biblia = null)
    {
        $this->biblia = $biblia;

        return $this;
    }

    /**
     * Get biblia
     *
     * @return Biblia
     */
    public function getBiblia()
    {
        return $this->biblia;
    }
    
    /**
     * Set code
     *
     * @param string $code
     *
     * @return Livro
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    
    
}
