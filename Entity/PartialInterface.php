<?php

namespace BBIT\PageBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

interface PartialInterface
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
     * @param ContainerInterface $container
     * @param Request $request
     * @return array
     */
    public function work(ContainerInterface $container, Request $request, $twigContext);
}
