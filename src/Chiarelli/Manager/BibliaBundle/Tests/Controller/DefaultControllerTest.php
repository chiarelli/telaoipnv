<?php

namespace Chiarelli\Manager\BibliaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
    
    public function getPathInSymfony() {
        
        $kernel = $this->get('kernel');
        
        $path = $kernel->locateResource('@ChiarelliManagerBibliaBundle/Resources');
        //$path = $this->get('kernel')->getRootDir();
        
        dump( $path );
        
    }
    
    
}
