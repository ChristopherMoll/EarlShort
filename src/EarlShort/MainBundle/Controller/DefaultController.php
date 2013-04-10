<?php

namespace EarlShort\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EarlShort\MainBundle\Entity\Link;
use EarlShort\MainBundle\Form\LinkType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $entity = new Link();
        $form   = $this->createForm(new LinkType(), $entity);

        return $this->render('EarlShortMainBundle:Default:index.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}
