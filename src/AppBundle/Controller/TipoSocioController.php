<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoSocio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tiposocio controller.
 *
 * @Route("tiposocio")
 */
class TipoSocioController extends Controller
{
    /**
     * Lists all tipoSocio entities.
     *
     * @Route("/", name="tiposocio_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoSocios = $em->getRepository('AppBundle:TipoSocio')->findAll();

        return $this->render('tiposocio/index.html.twig', array(
            'tipoSocios' => $tipoSocios,
            'entity_name' => 'Tipos de Socios',
        ));
    }

    /**
     * Creates a new tipoSocio entity.
     *
     * @Route("/new", name="tiposocio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoSocio = new Tiposocio();
        $form = $this->createForm('AppBundle\Form\TipoSocioType', $tipoSocio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoSocio);
            $em->flush();

            return $this->redirectToRoute('tiposocio_index');
        }

        return $this->render('tiposocio/new.html.twig', array(
            'tipoSocio' => $tipoSocio,
            'form' => $form->createView(),
            'action'=>'Crear',
            'entity_name' => 'Tipos de Socios',
        ));
    }

    /**
     * Finds and displays a tipoSocio entity.
     *
     * @Route("/{id}", name="tiposocio_show")
     * @Method("GET")
     */
    public function showAction(TipoSocio $tipoSocio)
    {
        $deleteForm = $this->createDeleteForm($tipoSocio);

        return $this->render('tiposocio/show.html.twig', array(
            'tipoSocio' => $tipoSocio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoSocio entity.
     *
     * @Route("/{id}/edit", name="tiposocio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoSocio $tipoSocio)
    {
        $deleteForm = $this->createDeleteForm($tipoSocio);
        $editForm = $this->createForm('AppBundle\Form\TipoSocioType', $tipoSocio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tiposocio_index');
        }

        return $this->render('tiposocio/edit.html.twig', array(
            'tipoSocio' => $tipoSocio,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'action'=>'Editar',
            'entity_name' => 'Tipos de Socios',
        ));
    }

    /**
     * Deletes a tipoSocio entity.
     *
     * @Route("/{id}", name="tiposocio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoSocio $tipoSocio)
    {
        $form = $this->createDeleteForm($tipoSocio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoSocio);
            $em->flush();
        }

        return $this->redirectToRoute('tiposocio_index');
    }

    /**
     * Creates a form to delete a tipoSocio entity.
     *
     * @param TipoSocio $tipoSocio The tipoSocio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoSocio $tipoSocio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposocio_delete', array('id' => $tipoSocio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
