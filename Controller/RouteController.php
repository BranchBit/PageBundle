<?php

namespace BBIT\PageBundle\Controller;

use BBIT\PageBundle\Entity\AbstractPage;
use BBIT\PageBundle\Entity\PageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RouteController extends Controller
{
    public function routeAction(Request $request, $uri)
    {
        /** @var AbstractPage $page */
        $page = $this->get('doctrine')->getManager()
            ->getRepository('BBITPageBundle:AbstractPage')
            ->findOneBy(['slug' => $uri]);

        if ($page) {

            return $this->renderPage($page, $request);


        } else {
            exit("00not found");
        }



        //$this->get('app.routing_loader')
        exit("render specific page");
    }

    private function renderPage(PageInterface $page, Request $request){
        $work = $page->work($this->container, $request);
        $page->setContainer($this->container);

        $work['_page'] = $page;


        return $this->render($page->getDefaultView(), $work);
    }

    public function homePageRouteAction(Request $request)
    {

        $page = $this->get('doctrine')
            ->getManager()
            ->getRepository('BBITPageBundle:AbstractPage')
            ->createQueryBuilder('x')
            ->andWhere('x INSTANCE OF :type')
            ->setParameter('type', 'homepage')
            ->getQuery()
            ->getOneOrNullResult();



        return $this->renderPage($page, $request);
    }
}
