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

    /**
     * @param ContainerInterface $container
     * @param Request $request
     * @return array
     */
    public function work(ContainerInterface $container, Request $request);

    public function setContainer(ContainerInterface $container);

    public function getContainer();

    public function __construct();
}
