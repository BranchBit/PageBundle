<?php

namespace BBIT\PageBundle\Controller;

use BBIT\PageBundle\Entity\TextPartial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RouteController extends Controller
{
    public function routeAction(Request $request, $uri)
    {

        $page = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('BBITPageBundle:AbstractPage')
            ->findOneBy(['slug' => $uri]);



        if ($page) {


            $work = $page->work($this->container, $request);

            $work['_page'] = $page;

            return $this->render($page->getDefaultTemplate(), $work);


        } else {
            exit("00not found");
        }



        //$this->get('app.routing_loader')
        exit("render specific page");
    }
}
