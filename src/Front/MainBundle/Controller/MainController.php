<?php

namespace Front\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontMainBundle:Main:index.html.twig');
    }
}
