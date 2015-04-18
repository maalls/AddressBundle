<?php

// src/AppBundle/Form/Type/GenderType.php
namespace Maalls\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZipcodeType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        //$resolver->setDefaults(new PointToArrayTransformer());
        
        //$resolver->addModelTransformer($pointTransformer);
       
    }


    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'zipcode';
    }
}