<?php

namespace Core2Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Core2Bundle:Default:index.html.twig');
    }
}
