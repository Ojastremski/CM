<?php

namespace CM\ConstructionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Construction/homepage.html.twig');
    }
}
