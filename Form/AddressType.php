<?php

namespace Maalls\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Maalls\AddressBundle\Form\ZipcodeType;
class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add("id", "hidden")
            ->add('country', "country")
            ->add('zip_code', new ZipcodeType())
            ->add('province')
            ->add('city')
            ->add('address_line1', 'text', array("label" => "Address"))
            ->add('address_line2', "text", array("required" => false, "label" => false))
            //->add($builder->create("geolocation")->addModelTransformer($pointTransformer))
            ->add("lat", "text", array('label' => 'Latitude', 'empty_data' => 0, "pattern" => "^[0-9]*$"))
            ->add("lng", "text", array('label' => 'Longitude', 'empty_data' => 0))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Maalls\AddressBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'address';
    }
}
