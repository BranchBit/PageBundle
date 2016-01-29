<?php

namespace BBIT\PageBundle\Form;

use BBIT\PageBundle\Entity\AbstractPartial;
use BBIT\PageBundle\Entity\PartialInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PartialType extends AbstractType
{

    protected $partial;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $partial = $this->partial;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder, $partial) {
            /** @var AbstractPartial $partial */
            $form = $event->getForm();
            $partial = $event->getData();

            if ($partial instanceof AbstractPartial) {
                $partialForm = $partial->getAdminFormType();
                $form->add($builder->getFormFactory()->createNamed(
                    'self',
                    get_class($partialForm),
                    null,
                    ['auto_initialize' => false]
                ));
            }

        });


//        $builder->add('self', TextPartialType::class);


        $builder->add('name', null, array('label' => 'name'));

        // get actual formtype for this partial // we fake text now


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BBIT\PageBundle\Entity\AbstractPartial',
        ));
    }
}
