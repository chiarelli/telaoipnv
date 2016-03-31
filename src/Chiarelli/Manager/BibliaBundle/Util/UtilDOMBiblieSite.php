<?php

namespace Chiarelli\Manager\BibliaBundle\Util;

use Chiarelli\Manager\BibliaBundle\Constantes\LangCode;
use Chiarelli\Manager\BibliaBundle\Constantes\Testment;
use Chiarelli\Manager\BibliaBundle\Entity\Biblia;
use Chiarelli\Manager\BibliaBundle\Entity\Capitulo;
use Chiarelli\Manager\BibliaBundle\Entity\Livro;
use Chiarelli\Manager\BibliaBundle\Entity\Versiculo;
use Chiarelli\Manager\BibliaBundle\Resources\lib\simple_html_dom;
use Chiarelli\Manager\BibliaBundle\Resources\lib\simple_html_dom_node;

class UtilDOMBiblieSite {
    
    public static function isLiLang( simple_html_dom_node $li ) {
        $result = FALSE;
        
        $key = array_search( 'sep', $li->attr );
        
        if ($key === 'class') {
            $result = TRUE;
        }

        return $result;
    }
    
    
    public static function takeProcessLangCode( simple_html_dom_node $li ) {
                
        if ( ! self::isLiLang( $li ) ) {
            return FALSE;
        }

        $attrs = array_reverse( explode('.', $li->attr['data-reactid'] ) );

        $code = substr( $attrs[0] , -2 );

        return LangCode::getInstanceOfCode($code);
    }
    
    public static function takeSigla( simple_html_dom_node $li ) {
        $sigla = \FALSE;
        
        if ( self::isLiLang( $li ) ) {
            return FALSE;
        }

        $attrs = array_reverse( explode('=', $li->attr['data-reactid'] ) );
        
        $sigla = substr( $attrs[0], 1);
        
        return $sigla;
        
    }
    
    public static function getAllBiblies( simple_html_dom $html ) {
        
        $ul = $html->find('ul[data-reactid=.0.1.1.$=1$slideout.0.$=1$bibles.1]')[0];
        
        $biblias = [];
        $langCode = FALSE;
        
        foreach ( $ul->find('li') as $li ) {
            
            if( $langCode && ! UtilDOMBiblieSite::isLiLang( $li ) ) {
                
                $biblia = new Biblia();
                    $biblia->setLangCode($langCode);
                    $biblia->setDescricao( $li->find('a')[0]->innertext );
                    $biblia->setSigla( UtilDOMBiblieSite::takeSigla($li) );
                
                $biblias[] = $biblia;
            } else {
                
                $langCode = UtilDOMBiblieSite::takeProcessLangCode($li);
                
            }
            
        }
        
        return $biblias;
        
    }
    
    public static function injectionAllChapter( Livro &$livro, $codeBiblie = 'acf' ) {
        
        $chapterList = self::getAllChapter($livro, $codeBiblie);
        
        foreach ( $chapterList as $chapter) {
            $livro->addCapitulo($chapter);                
        }
        
    }
    
    public static function getAllChapter( Livro $livro, $codeBiblie = 'acf' ) {
        
        $codeBook = $livro->getCode();
        
        $html = ConnectBiblia::getSiteDOM($codeBiblie, $codeBook);
        
        $chapterListDom = $html->find('.ChapterList')[0];
        
        $chapterList = [];
        $number = 1;
        foreach ( $chapterListDom->find('li') as $liDom) {
            
            $chapter = new Capitulo();
                $chapter->setLivro($livro);
                $chapter->setNumber( $number++ );
            $chapterList[] = $chapter;
        }
        
        return $chapterList;
        
    }
    
    static function injectionAllVersicles( Capitulo &$chapter, $codeBiblie = 'acf', $codeBook = 'gn' ) {
        
        $verseList = self::getAllVersicles($chapter, $codeBiblie, $codeBook);
        
        foreach ($verseList as $verse) {
            $chapter->addVersiculo($verse);
        }
        
    }
    
    static function getAllVersicles( Capitulo $chapter, $codeBiblie = 'acf', $codeBook = 'gn' ) {
        
        $html = ConnectBiblia::getSiteDOM( $codeBiblie, $codeBook, $chapter->getNumber() );
        
        $bible_verses_dom = $html->find('div.verses span.text');
        
        $verseList = [];
        $number = 1;
        foreach ($bible_verses_dom as $spanDom) {
            
            $verse = new Versiculo();
                $verse->setCapitulo($chapter);
                $verse->setContent( $spanDom->innertext );
                $verse->setNumber($number++);
            $verseList[] = $verse;
        }
        
        return $verseList;
    }
    
    static function countVersicles( Capitulo $chapter, $codeBiblie = 'acf', $codeBook = 'gn' ) {
        $html = ConnectBiblia::getSiteDOM( $codeBiblie, $codeBook, $chapter->getNumber() );
        
        $bible_verses_dom = $html->find('div.verses span.text');
        
        return \count( $bible_verses_dom );
    }
    
    static function getAllBooks( simple_html_dom $html ) {
        
        $books = array_merge(
            self::takeBooksTestament('oldTestament', $html),
            self::takeBooksTestament('newTestament', $html) 
        );        
                
        return $books;            
    }
    
    private static function takeBooksTestament( $testament_name, simple_html_dom $html ) {
        
        $DOM_testament = $html->find("div.{$testament_name}")[0];
        
        $testament = \NULL;
        switch ($testament_name) {
            case 'newTestament':
                $testament = Testment::define( Testment::NEW_TESTMENT );
                break;
            
            case 'oldTestament':
                $testament = Testment::define( Testment::OLD_TESTMENT );
                break;
            
            default:
                break;
        }
        
        $DOM_li = $DOM_testament->find('li');
        
        $books = [];
        foreach ($DOM_li as $li) {
                        
            $DOM_a = $li->find('a')[0];
            
            $attrs = array_reverse( explode('$', $li->attr['data-reactid'] ) );
            $code = $attrs[0];
            
            $livro = new Livro();
                $livro->setName( $DOM_a->innertext );
                $livro->setNumber( substr( $li->attr['class'], 1) );
                $livro->setCode( $code );
                $livro->setTestment($testament);
            $books[] = $livro;
        }
        
        return $books;        
    }
    
    
}
