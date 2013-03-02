<?php

namespace MapaComedoresSociales\PantryBundle\Controller;

use Ivory\GoogleMap\Controls\ControlPosition;

use MapaComedoresSociales\PantryBundle\Form\PantryFilterType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MapaComedoresSociales\PantryBundle\Entity\Pantry;
use MapaComedoresSociales\PantryBundle\Form\PantryType;

/**
 * Pantry controller.
 *
 */
class PantryController extends Controller
{
    /**
     * Lists all Pantry entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PantryBundle:Pantry')->findAll();

        return $this->render('PantryBundle:Pantry:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Pantry entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PantryBundle:Pantry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PantryBundle:Pantry:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Pantry entity.
     *
     */
    public function newAction()
    {
        $entity = new Pantry();
        $flow = $this->get('mapacomedoressociales.form.flow.pantry_type_flow');
//         $flow->reset();
        $flow->bind($entity);

        // form of the current step
        $form = $flow->createForm($entity);
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData();
            if ($flow->nextStep()) {
                if ($flow->getCurrentStep() === 2) {
                    $map = $this->get('ivory_google_map.map');
                    $panControl = $this->get('ivory_google_map.pan_control');
                    $marker = $this->get('ivory_google_map.marker');

                    $map->setCenter($entity->getLatitude(), $entity->getLongitude(), true);
                    $map->setMapOption('zoom', 18);
                    $map->setPanControl($panControl);
                    $map->setPanControl(ControlPosition::TOP_LEFT);

                    $marker->setJavascriptVariable('marker_final');
                    $marker->setPosition($entity->getLatitude(), $entity->getLongitude());
                    $marker->setOption('draggable', true);

                    // Add the marker to the map
                    $map->addMarker($marker);
                }
                // form for the next step
                $form = $flow->createForm($entity);
            } else {
                // flow finished
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();
                $flow->reset();

                return $this->redirect($this->generateUrl('_welcome'));
            }
        }

        return $this->render('PantryBundle:Pantry:new.html.twig', array(
                'form' => $form->createView(),
                'flow' => $flow,
                'map' => isset($map) ? $map : null
        ));
    }

    /**
     * Creates a new Pantry entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Pantry();
        $form = $this->createForm(new PantryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pantry_show', array('id' => $entity->getId())));
        }

        return $this->render('PantryBundle:Pantry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pantry entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PantryBundle:Pantry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantry entity.');
        }

        $editForm = $this->createForm(new PantryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PantryBundle:Pantry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Pantry entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PantryBundle:Pantry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PantryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pantry_edit', array('id' => $id)));
        }

        return $this->render('PantryBundle:Pantry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pantry entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PantryBundle:Pantry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pantry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pantry'));
    }

    /**
     * Filter pantries.
     */
    public function filterAction(Request $request)
    {
        $params = $request->request->get('mapacomedoressociales_pantrybundle_pantryfiltertype');
        $geocoder = $this->get('ivory_google_map.geocoder');
        $response = $geocoder->geocode($params['location']);
        $result = current($response->getResults());
        var_dump($result); die();
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
