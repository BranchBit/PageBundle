<?php

namespace BBIT\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminPageController extends Controller
{
    public function indexAction()
    {
        $entityName = 'BBITPageBundle:Page';

        $items = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository($entityName)
            ->createQueryBuilder('x')
            ->getQuery()
            ->getResult();
        return $this->render('BBITAdminBundle:pages:index.html.twig', ['items' => $items]);
    }
}
