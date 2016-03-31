<?php

namespace Chiarelli\Manager\BibliaBundle\Util;

use Chiarelli\Manager\BibliaBundle\Entity\Capitulo;
use Chiarelli\Manager\BibliaBundle\Entity\Livro;
use Chiarelli\Manager\BibliaBundle\Resources\lib\simple_html_dom;

class CreateBiblieDefaultJson {
    
    private $html;
    
    function __construct( $content_html ) {
        $this->html = new simple_html_dom(); 
            $this->html->load($content_html);
    }
            
    function setHtmlDom( simple_html_dom $html ){        
        $this->html = $html;
    }

    function getArrayBiblies() { 
        
        $biblies = UtilDOMBiblieSite::getAllBiblies( $this->html );
        
        $bibliesArray = [];
        foreach ($biblies as $biblia) {
            $vars = $biblia->toArray();
            unset( $vars['livros'] );
            $bibliesArray[] = $vars;
        }
        
        return $bibliesArray;
    }
    
    function getArrayBooks() {
        
        $books = UtilDOMBiblieSite::getAllBooks($this->html);
        
        $booksArray = [];
        foreach ($books as $book) {
            $vars = $book->toArray();
                unset( $vars['biblia'] );
                unset( $vars['id'] );             
            $booksArray[] = $vars;
        }
        
        return $booksArray;
    }
    
    function getArrayChapter( $codeBook ) {
        
        $livro = new Livro();
            $livro->setCode($codeBook);
        
        $chapters = UtilDOMBiblieSite::getAllChapter( $livro );
        
        $chapterList = [];
        foreach ($chapters as $chapter) {
            $vars = $chapter->toArray();
                $vars['livroCode'] = $vars['livro']['code'];
                $vars['totalVerses'] = NULL;
                unset( $vars['livro'] );
                unset( $vars['id'] );
                unset( $vars['versiculos'] );
            $chapterList[] = $vars;
        }
        
        return $chapterList;        
    }
    
    function getArrayVerses( $codeBook, $numberchapter ) {
        
        $chapter = new Capitulo();
            $chapter->setNumber($numberchapter);
        
        $verses = UtilDOMBiblieSite::getAllVersicles($chapter, 'nvi', $codeBook);
        
        $versesList = [];
        foreach ($verses as $verse) {
            $vars = $verse->toArray();
                unset( $vars['id'] );
                unset( $vars['capitulo'] );
            $versesList[] = $vars;
        }
        
        
        return $versesList;        
    }
    
    function getJson() {
        
        $json['biblies'] = $this->getArrayBiblies();
        $json['books'] = $this->insertChaptersInBooks();
        
        return json_encode( $json );
    }
    
    private function insertChaptersInBooks() {
        $books = $this->getArrayBooks();
        
        for ($index = 0; $index < count($books); $index++) {
            
            $books[$index]['capitulos'] 
                    = $this->insertTotalVersesInChapters( 
                                $books[$index]['code'] 
                            );
            
            
        }
        return $books;
    }
    
    private function insertTotalVersesInChapters( $codeBook ){
        
        $chapters = $this->getArrayChapter( $codeBook );
        
        
        for ($index = 0; $index < count($chapters); $index++) {
            
            $chapter = new Capitulo();
                $chapter->setNumber($chapters[$index]['number']);
            
            $total = UtilDOMBiblieSite::countVersicles(
                        $chapter, 
                        'acf', 
                        $chapters[$index]['livroCode']  
                    );
            
                    /*
            $verses = $this->getArrayVerses(
                        $chapters[$index]['livroCode'], 
                        $chapters[$index]['number']
                    );
                     * 
                     */
        
            $chapters[$index]['totalVerses'] = $total;
        }
        
        return $chapters;
    }
    
    
}
