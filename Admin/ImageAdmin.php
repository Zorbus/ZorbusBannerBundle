<?php

namespace Zorbus\BannerBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class ImageAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('banner', null, array('required' => true))
                ->add('title')
                ->add('description', 'textarea', array('required' => false, 'attr' => array('class' => 'ckeditor')))
                ->add('imageTemp', 'file', array('required' => true, 'label' => 'Image'))
                ->add('position')
                ->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('title')
                ->add('banner')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->addIdentifier('banner')
                ->add('enabled')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
                ->with('title')
                ->assertNotBlank()
                ->assertMaxLength(array('limit' => 255))
                ->end()
        ;
    }

    public function prePersist($object)
    {
        $object->setUpdatedAt(new \DateTime());
    }

    public function preUpdate($object)
    {
        $object->setUpdatedAt(new \DateTime());
    }

}