<?php
namespace BBIT\PageBundle\Entity;

use BBIT\PageBundle\Form\AdminTextPartialType;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractPartial implements PartialInterface
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
    protected $name;



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

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



    public function getAdminView()
    {
        return $this->getDefaultView();
    }


    public function getView()
    {
        return $this->getDefaultView();
    }

    public function getDefaultTemplate()
    {
        return 'BBITPageBundle:Default:partial.html.twig';
    }

    public function getAdminFormType()
    {
        return new AdminTextPartialType();
    }
}
