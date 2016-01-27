<?php

namespace BBIT\PageBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdminPageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('id', HiddenType::class);
        $builder->add('title', TextType::class, array('label' => 'title'));
        $builder->add('slug', null, array('label' => 'slug'));

        $builder->add('partials', CollectionType::class, array(
            'entry_type' => PartialType::class
        ));


        //exit(var_dump($builder->get('partials')->count()));

        $builder->add('save', SubmitType::class, array('label' => 'save'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BBIT\PageBundle\Entity\AbstractPage',
            //'data_class' => null,
        ));
    }
}
