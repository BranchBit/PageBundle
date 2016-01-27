<?php
namespace BBIT\PageBundle\Twig;


use BBIT\PageBundle\Entity\PageInterface;
use BBIT\PageBundle\Entity\TextPartial;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_SimpleFunction;

class RenderPartialsExtension extends \Twig_Extension
{
    private $em;

    private $requestStack;



    public function __construct($em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction(
                'render_partials',
                [$this, 'renderPartials'],
                array(
                    'needs_environment' => true,
                    'needs_context' => true,
                    'is_safe' => array('html')
                )
            ),
        );
    }

    public function collectPartials(PageInterface $page, $name)
    {

        $partials = new ArrayCollection();
        $partial = new TextPartial();
        $partial->setContent('CONTENT OF PARTIAL1');
        $partials->add($partial);
        $partial = new TextPartial();
        $partial->setContent('CONTENT OF PARTIAL2');
        $partials->add($partial);
        $partial = new TextPartial();
        $partial->setContent('CONTENT OF PARTIAL3');
        $partials->add($partial);

        return $partials;
    }

    public function renderPartials(\Twig_Environment $environment, $context, PageInterface $page, $name)
    {

        //render all partials for page that are in region name
        $partials = $this->collectPartials($page, $name);

        $content = "";
        foreach ($partials as $partial) {

            $content .= $environment->loadTemplate($partial->getDefaultView())->render($partial->work($context));
        }

        return $content;
    }


    public function getName()
    {
        return 'bbit_render_partials';
    }
}
