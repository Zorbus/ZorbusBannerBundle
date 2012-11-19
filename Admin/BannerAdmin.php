<?php

namespace Zorbus\BannerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\NotBlank;

class BannerAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('name', null, array(
                    'constraints' => array(
                        new NotBlank(),
                        new MaxLength(array('limit' => 255))
                    )
                ))
                ->add('description', 'textarea', array(
                    'required' => false,
                    'attr' => array('class' => 'ckeditor')
                ))
                ->add('lang', 'language', array('preferred_choices' => array('pt_PT', 'en')))
                ->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('name')
                ->add('enabled')
        ;
    }

}