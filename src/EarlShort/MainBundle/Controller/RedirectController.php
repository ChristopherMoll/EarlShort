<?php

namespace EarlShort\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RedirectController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('EarlShortMainBundle:Link');
        $link = $repository->findOneBy(array('path' => $page));

        if($link->isExpired())
            throw $this->createNotFoundException('This page has expired');

        $link->setVisitCount();
        $em->persist($link);
        $em->flush();
        $destination = $link->getDestination();
        return $this->redirect($destination);

    }

}
