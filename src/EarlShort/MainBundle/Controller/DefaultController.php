<?php

namespace EarlShort\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EarlShortMainBundle:Default:index.html.twig', array('name' => 'chris'));
    }
}
