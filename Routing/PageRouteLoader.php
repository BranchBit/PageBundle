<?php
namespace BBIT\PageBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class PageRouteLoader extends Loader
{
    private $loaded = false;



    public function load($resource, $type = null)
    {



        //CATCH ANY ROUTE, ADD {URL} IF


        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "pageroute" loader twice');
        }

        $routes = new RouteCollection();

        // prepare a new route
        $path = '/{uri}';
        $defaults = array(
            '_controller' => 'BBITPageBundle:Route:route',
        );
        $requirements = array(
            //'uri' => '\d+',
        );
        $route = new Route($path, $defaults, $requirements);

        // add the new route to the route collection
        $routeName = 'extraRoute';
        $routes->add($routeName, $route);

        $this->loaded = true;

        return $routes;
    }

    public function supports($resource, $type = null)
    {
        return 'page_route' === $type;
    }
}
