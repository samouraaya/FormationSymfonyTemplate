<?php

namespace Core2Bundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Core2Bundle\Entity\Product;

class ProductTest extends WebTestCase
{
    public function testIndex()
    {
        $p=new Product();
        $p->setName("product 1");
        $this->assertEquals($p->getSlugConstruct(), "product 1");
    }
}