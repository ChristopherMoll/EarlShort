<?php

namespace EarlShort\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LoginController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('EarlShortMainBundle:Login:index.html.twig', array('name' => 'chris'));
    }

    /**
     * @Route("/login_check")
     * @Template()
     */
    public function checkAction()
    {
    }

    /**
     * @Route("/logout")
     * @Template()
     */
    public function logoutAction()
    {
        return $this->render('EarlShortMainBundle:Default:index.html.twig', array('name' => 'chris'));
    }

}
