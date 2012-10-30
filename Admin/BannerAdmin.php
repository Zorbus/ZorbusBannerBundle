<?php

namespace Zorbus\BannerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class BannerAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('name')
                ->add('description', 'textarea', array(
                    'required' => false,
                    'attr' => array('class' => 'ckeditor')
                ))
                ->add('lang')
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

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
                ->with('name')
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 255))
                ->end()
        ;
    }

}