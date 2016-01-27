<?php

namespace BBIT\PageBundle\Entity;



use Symfony\Component\HttpFoundation\Request;

interface PartialInterface
{

    public function getDefaultView();

    public function work($pageContext);
}
