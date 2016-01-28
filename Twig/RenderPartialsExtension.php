<?php
namespace BBIT\PageBundle\Twig;


use BBIT\PageBundle\Entity\AbstractPartial;
use BBIT\PageBundle\Entity\PageInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class RenderPartialsExtension
 * @package BBIT\PageBundle\Twig
 */
class RenderPartialsExtension extends Twig_Extension
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
//            new Twig_SimpleFunction(
//                'render_page',
//                [$this, 'renderPartials'],
//                array(
//                    'needs_environment' => true,
//                    'needs_context' => true,
//                )
//            )
        );
    }

    /**
     * @param PageInterface $page
     * @param $name
     * @return AbstractPartial[]
     */
    public function collectPartials(PageInterface $page, $name)
    {
        $filtered = $page->getPartials()->filter(
            function($entry) use ($name) {
                return ($entry->getRegion() === $name);
            }
        );

        return $filtered;
    }

    /**
     * @param Twig_Environment $environment
     * @param $context
     * @param PageInterface $page
     * @param $name
     * @return string
     **/
    public function renderPartials(Twig_Environment $environment, $context, PageInterface $page, $name)
    {
        $partials = $this->collectPartials($page, $name);



        /** @var AppVariable $appvariable */
        $appvariable = $context['app'];

        $content = '';
        foreach ($partials as $partial) {
            try {
                $content .= $environment->loadTemplate($partial->getDefaultView())->render(
                    $partial->work($page->getContainer(), $appvariable->getRequest(), $context)
                );
            } catch (\Exception $e) {
                $content = $e->getMessage();
            }
        }

        return $content;
    }

//    public function renderPage(\Twig_Environment $environment, $context, PageInterface $page)
//    {
//
//        //$content = $environment->loadTemplate($page->getDefaultView())->render($page->work($context));
//
//        $template = $this->environment->loadTemplate($page->getDefaultView());
//
//        return $template->render(array_merge([], $page->work($context)));
//
//        return $content;
//    }


    public function getName()
    {
        return 'bbit_render_partials';
    }
}
