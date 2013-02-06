<?php

namespace MapaComedoresSociales\GeoLocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MapaComedoresSociales\GeoLocationBundle\Entity\GeoArea;
use MapaComedoresSociales\GeoLocationBundle\Form\GeoAreaType;

/**
 * GeoArea controller.
 *
 */
class GeoAreaController extends Controller
{
    /**
     * Lists all GeoArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GeoLocationBundle:GeoArea')->findAll();

        return $this->render('GeoLocationBundle:GeoArea:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a GeoArea entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeoLocationBundle:GeoArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GeoLocationBundle:GeoArea:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new GeoArea entity.
     *
     */
    public function newAction()
    {
        $entity = new GeoArea();
        $form   = $this->createForm(new GeoAreaType(), $entity);

        return $this->render('GeoLocationBundle:GeoArea:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new GeoArea entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new GeoArea();
        $form = $this->createForm(new GeoAreaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('geoarea_show', array('id' => $entity->getId())));
        }

        return $this->render('GeoLocationBundle:GeoArea:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GeoArea entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeoLocationBundle:GeoArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoArea entity.');
        }

        $editForm = $this->createForm(new GeoAreaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GeoLocationBundle:GeoArea:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing GeoArea entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeoLocationBundle:GeoArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new GeoAreaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('geoarea_edit', array('id' => $id)));
        }

        return $this->render('GeoLocationBundle:GeoArea:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GeoArea entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GeoLocationBundle:GeoArea')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GeoArea entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('geoarea'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
