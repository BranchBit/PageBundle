<?php

namespace BBIT\PageBundle\Controller;

use AppBundle\Entity\TestPage;
use BBIT\PageBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminPageController extends Controller
{
    public function indexAction()
    {
        $entityName = 'BBITPageBundle:AbstractPage';

        $items = $this->get('doctrine')
            ->getManager()
            ->getRepository($entityName)
            ->createQueryBuilder('x')
            ->getQuery()
            ->getResult();

        return $this->render('BBITAdminBundle:pages:index.html.twig', ['items' => $items]);
    }

    public function editAction(Request $request, $id)
    {
        $item = $this->get('doctrine')
            ->getManager()
            ->getRepository('BBITPageBundle:AbstractPage')
            ->find($id);

        $formClass = $item->getAdminFormType();
        $form = $this->createForm(get_class($formClass), $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bbit_pages');
        }


        return $this->render('BBITAdminBundle:pages:edit.html.twig', ['item' => $item, 'form' => $form->createView()]);
    }

    public function createAction(Request $request)
    {
        $item = new Page();

        $formClass = $item->getAdminFormType();
        $form = $this->createForm(get_class($formClass), $item);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($item);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bbit_pages');
        }


        return $this->render('BBITAdminBundle:pages:create.html.twig', ['form' => $form->createView()]);
    }

    public function removeAction(Request $request, $id)
    {
        $item = $this->get('doctrine')
            ->getManager()
            ->getRepository('BBITPageBundle:AbstractPage')
            ->find($id);

        $this->getDoctrine()->getManager()->remove($item);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('bbit_pages');
    }


}
