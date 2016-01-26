<?php

namespace BBIT\PageBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="bbit_partial_text")
 * @ORM\HasLifecycleCallbacks()
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


    public function getDefaultView()
    {
        return 'BBITPageBundle:Default:partial_text.html.twig';
    }

    public function work(ContainerInterface $container, Request $request)
    {
        return ['content' => $this->content];
    }
}
