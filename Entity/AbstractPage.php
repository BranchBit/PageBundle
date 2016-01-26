<?php

namespace BBIT\PageBundle\Entity;

use BBIT\PageBundle\Form\AdminPageType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


abstract class AbstractPage implements PageInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    public function getAdminFormType()
    {
        return new AdminPageType();
    }

    public function getDefaultTemplate()
    {
        return 'BBITPageBundle:Default:page.html.twig';
    }

    //work method
}
