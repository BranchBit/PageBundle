<?php

namespace BBIT\PageBundle\Entity;

use Symfony\Component\Form\FormTypeInterface;

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

    public function work($pageContext);
}
