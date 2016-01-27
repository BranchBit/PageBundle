<?php

namespace BBIT\PageBundle\Controller;

use BBIT\PageBundle\Entity\AbstractPage;
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

            $work = $page->work($this->container, $request);

            $work['_page'] = $page;

            return $this->render($page->getDefaultView(), $work);


        } else {
            exit("00not found");
        }



        //$this->get('app.routing_loader')
        exit("render specific page");
    }
}
