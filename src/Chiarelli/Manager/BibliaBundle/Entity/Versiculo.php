<?php

namespace Chiarelli\Manager\BibliaBundle\Entity;

use Chiarelli\Manager\BibliaBundle\Lang\Object;

/**
 * Versiculo
 */
class Versiculo extends Object
{
    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Capitulo
     */
    private $capitulo;


    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Versiculo
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
     * @return Versiculo
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
     * Set content
     *
     * @param string $content
     *
     * @return Versiculo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Set capitulo
     *
     * @param Capitulo $capitulo
     *
     * @return Versiculo
     */
    public function setCapitulo(Capitulo $capitulo = null)
    {
        $this->capitulo = $capitulo;

        return $this;
    }

    /**
     * Get capitulo
     *
     * @return Capitulo
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }
    
    
    
}
