<?php

namespace BBIT\PageBundle\Entity;

use BBIT\PageBundle\Form\TextPartialType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class TextPartial extends AbstractPartial
{

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getAdminFormType()
    {
        return new TextPartialType();
    }


    public function getDefaultView()
    {
        return 'BBITPageBundle:Default:partial_text.html.twig';
    }

    public function work($pageContext)
    {
        return ['content' => $this->content];
    }
}
