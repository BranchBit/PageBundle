<?php

namespace BBIT\PageBundle\Entity;

use BBIT\PageBundle\Form\AdminPageType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractPage
 * @package BBIT\PageBundle\Entity
 * @ORM\Entity(repositoryClass="AbstractPageRepository", )
 * @ORM\Table(name="bbit_pages")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
abstract class AbstractPage implements PageInterface
{

    private $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer(){
        return $this->container;
    }

    public function __construct()
    {
        $this->partials = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="BBIT\PageBundle\Entity\AbstractPartial")
     * @ORM\JoinTable(name="pages_partials",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="partial_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $partials;

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
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $slug;

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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

    public function getDefaultView()
    {
        return 'BBITPageBundle:Default:page.html.twig';
    }

    /**
     * @return mixed
     */
    public function getPartials()
    {
        return $this->partials;
    }

    /**
     * @param mixed $partials
     */
    public function setPartials($partials)
    {
        $this->partials = $partials;
    }


        //work method
}
