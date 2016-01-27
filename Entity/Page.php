<?php

namespace BBIT\PageBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Page extends AbstractPage
{

    public function getDefaultView()
    {
        return 'BBITPageBundle:Default:page.html.twig';
    }

    public function work(ContainerInterface $container, Request $request)
    {
        return ['title' => $this->title, 'test' => 'test123', 'test2' => 'test'];
    }

}
