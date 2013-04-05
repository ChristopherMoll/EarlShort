<?php

namespace EarlShort\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path')
            ->add('destination')
            ->add('expiration','date',array(
                'data' => new \DateTime('tomorrow'),
                'attr' => array('class' => 'date'),
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'years'  => range(date('Y'), date('Y') + 1),

            ))
            ->add('visitLimit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EarlShort\MainBundle\Entity\Link'
        ));
    }

    public function getName()
    {
        return 'earlshort_mainbundle_linktype';
    }
}
