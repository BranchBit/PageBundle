<?php

namespace BBIT\PageBundle\Entity;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

interface PageInterface
{
    public function getDefaultView();

    /**
     * @return AbstractPartial[]|null
     */
    public function getPartials();
    public function work(ContainerInterface $container, Request $request);
}
