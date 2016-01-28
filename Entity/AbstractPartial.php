<?php
namespace BBIT\PageBundle\Entity;

use BBIT\PageBundle\Form\AdminTextPartialType;
use BBIT\PageBundle\Form\PartialType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class AbstractPartial
 * @package BBIT\PageBundle\Entity
 * @ORM\Entity(repositoryClass="AbstractPartialRepository", )
 * @ORM\Table(name="bbit_partials")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
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
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $region;

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getSelf(){
        return $this;
    }

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

    public function getDefaultView()
    {
        return 'BBITPageBundle:Default:partial.html.twig';
    }

    public function getAdminFormType()
    {
        return new PartialType();
    }
}
