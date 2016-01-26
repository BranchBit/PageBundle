<?php

namespace BBIT\PageBundle\Controller;

use BBIT\PageBundle\Entity\TextPartial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RouteController extends Controller
{
    public function routeAction(Request $request, $uri)
    {
        //fake textpartial
        $partial = new TextPartial();
        $partial->setContent('CONTENT OF PARTIAL');

        $page = $this->get('doctrine.orm.default_entity_manager')
            ->getRepository('BBITPageBundle:Page')
            ->findOneBy(['title' => $uri]);

        if ($page) {

            $work = $page->work($this->container, $request);

            $work['_regions'] = [];
            $work['_regions'] = [];
            $work['_regions']['_main'] = [];
            $work['_regions']['_main']['_partials'] = [];
            $work['_regions']['_main']['_partials'][] = $this->get('templating')->render($partial->getDefaultView(), $partial->work($this->container, $request));
            $work['_regions']['_main']['_partials'][] = $this->get('templating')->render($partial->getDefaultView(), $partial->work($this->container, $request));
            $work['_regions']['_bottom'] = [];
            $work['_regions']['_bottom']['_partials'] = [];
            $work['_regions']['_bottom']['_partials'][] = $this->get('templating')->render($partial->getDefaultView(), $partial->work($this->container, $request));

            return $this->render($page->getDefaultTemplate(), $work);


        } else {
            exit("00not found");
        }



        //$this->get('app.routing_loader')
        exit("render specific page");
    }
}
