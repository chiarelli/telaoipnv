<?php

namespace Chiarelli\Manager\BibliaBundle\Entity;

use Chiarelli\Manager\BibliaBundle\Constantes\LangCode;
use Chiarelli\Manager\BibliaBundle\Lang\Object;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Biblia extends Object {
    
    /**
     * @var string
     */
    private $descricao;

    /**
     * @var string
     */
    private $langCode;

    /**
     * @var string
     */
    private $sigla;

    /**
     * @var Collection
     */
    private $livros;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->livros = new ArrayCollection();
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Biblia
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set langCode
     *
     * @param LangCode $langCode
     *
     * @return Biblia
     */
    public function setLangCode(LangCode $langCode)
    {
        $this->langCode = $langCode->getCode();

        return $this;
    }

    /**
     * Get langCode
     *
     * @return LangCode
     */
    public function getLangCode()
    {
        return LangCode::getInstanceOfCode( $this->langCode );
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return Biblia
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Add livro
     *
     * @param Livro $livro
     *
     * @return Biblia
     */
    public function addLivro(Livro $livro)
    {
        $this->livros[] = $livro;

        return $this;
    }

    /**
     * Remove livro
     *
     * @param Livro $livro
     */
    public function removeLivro(Livro $livro)
    {
        $this->livros->removeElement($livro);
    }

    /**
     * Get livros
     *
     * @return Collection
     */
    public function getLivros()
    {
        return $this->livros;
    }
    
    
    
    
    
}
