<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManager;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Category{
    
    private $_em;
    
    public function __construct(EntityManager $em){
        $this->_em = $em;
    }


    public function  count(){
        
        $categorys = $this->_em->getRepository('Core2Bundle:Category')->findAll();
        
        return count($categorys);
    }
}