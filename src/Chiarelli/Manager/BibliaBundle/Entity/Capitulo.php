<?php

namespace Chiarelli\Manager\BibliaBundle\Entity;

use Chiarelli\Manager\BibliaBundle\Lang\Object;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * Capitulo
 */
class Capitulo extends Object
{
    /**
     * @var integer
     */
    private $number;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Collection
     */
    private $versiculos;

    /**
     * @var Livro
     */
    private $livro;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->versiculos = new ArrayCollection();
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Capitulo
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
     * Set nome
     *
     * @param string $nome
     *
     * @return Capitulo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
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
     * Add versiculo
     *
     * @param Versiculo $versiculo
     *
     * @return Capitulo
     */
    public function addVersiculo(Versiculo $versiculo)
    {
        $this->versiculos[] = $versiculo;

        return $this;
    }

    /**
     * Remove versiculo
     *
     * @param Versiculo $versiculo
     */
    public function removeVersiculo(Versiculo $versiculo)
    {
        $this->versiculos->removeElement($versiculo);
    }

    /**
     * Get versiculos
     *
     * @return Collection
     */
    public function getVersiculos()
    {
        return $this->versiculos;
    }

    /**
     * Set livro
     *
     * @param Livro $livro
     *
     * @return Capitulo
     */
    public function setLivro(Livro $livro = null)
    {
        $this->livro = $livro;

        return $this;
    }

    /**
     * Get livro
     *
     * @return Livro
     */
    public function getLivro()
    {
        return $this->livro;
    }
    
    
}
