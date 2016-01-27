<?php
namespace BBIT\PageBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack, $em)
    {
        $menu = $this->factory->createItem('root');

        $items = $em
            ->getRepository('BBITPageBundle:AbstractPage')
            ->createQueryBuilder('x')
            ->getQuery()
            ->getResult();

        //check if home homepage exists, and put it there



        foreach ($items as $item) {
            $menu->addChild($item->getTitle(), array('route' => 'extraRoute', 'routeParameters' => ['uri' => $item->getSlug()]));
        }


        // ... add more children

        return $menu;
    }
}
