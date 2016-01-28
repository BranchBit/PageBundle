<?php

namespace BBIT\PageBundle\Entity;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

interface PageInterface
{
    /**
     * @return FormTypeInterface
     */
    public function getAdminFormType();

    /**
     * @return string
     */
    public function getDefaultView();

    /**
     * @return AbstractPartial[]|null
     */
    public function getPartials();
    public function work(ContainerInterface $container, Request $request);
}
