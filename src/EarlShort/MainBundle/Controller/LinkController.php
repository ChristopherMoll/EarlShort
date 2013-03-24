<?php

namespace EarlShort\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use EarlShort\MainBundle\Entity\Link;
use EarlShort\MainBundle\Form\LinkType;

/**
 * Link controller.
 *
 */
class LinkController extends Controller
{
    /**
     * Lists all Link entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EarlShortMainBundle:Link')->findAll();

        return $this->render('EarlShortMainBundle:Link:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Link entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Link();
        $form = $this->createForm(new LinkType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setCreator($this->getUser())->setCreated()->setUpdated()->setVisitCount(0);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('link_show', array('id' => $entity->getId())));
        }

        return $this->render('EarlShortMainBundle:Link:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Link entity.
     *
     */
    public function newAction()
    {
        $entity = new Link();
        $form   = $this->createForm(new LinkType(), $entity);

        return $this->render('EarlShortMainBundle:Link:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Link entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EarlShortMainBundle:Link')->find($id);
        $entity->setVisitCount();
        $em->persist($entity);
        $em->flush();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Link entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EarlShortMainBundle:Link:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Link entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EarlShortMainBundle:Link')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Link entity.');
        }

        $editForm = $this->createForm(new LinkType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EarlShortMainBundle:Link:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Link entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EarlShortMainBundle:Link')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Link entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LinkType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('link_edit', array('id' => $id)));
        }

        return $this->render('EarlShortMainBundle:Link:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Link entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EarlShortMainBundle:Link')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Link entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('link'));
    }

    /**
     * Creates a form to delete a Link entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
