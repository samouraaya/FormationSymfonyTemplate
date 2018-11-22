<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($x)
    {
        $data = [
            [
                'name' => 'mohamed',
                'email' => 'mohamed@gmail.com'
            ],
            [
                'name' => 'mohamed',
                'email' => 'mohamed@gmail.com'
            ],
        ];
        return $this->render('CoreBundle:Default:index.html.twig', [
            'data' => $data]);
        
        
//        dump($x);
//        exit();
//        debug code
//        $y = $x * 5;
//        return $this->render('CoreBundle:Default:index.html.twig', [
//            'x' => $x,
//            'h' => $y]);
        #return $this->render('@Core/Default/index.html.twig'); 
        #1 er solution pour résoudre le pb de unable to find template
    }
    
    public function testAction(){
        return $this->render('CoreBundle:Default:test.html.twig', [
            ]);
    }
}
