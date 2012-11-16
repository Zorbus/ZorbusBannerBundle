<?php

namespace Zorbus\BannerBundle\Model;

use Zorbus\BlockBundle\Entity\Block as BlockEntity;
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Form\FormFactory;
use Zorbus\BlockBundle\Model\BlockConfig;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Min;

class BlockBannerConfig extends BlockConfig
{

    public function __construct(AdminInterface $admin, FormFactory $formFactory, $httpKernel)
    {
        parent::__construct('zorbus_banner.block.banner', 'Banner Block', $admin, $formFactory);
        $this->enabled = true;
        $this->httpKernel = $httpKernel;
    }

    public function getFormMapper()
    {
        return $this->formMapper
                        ->add('banner', 'entity', array(
                            'class' => 'Zorbus\BannerBundle\Entity\Banner',
                            'attr' => array('class' => 'span5 select2'),
                            'constraints' => array(
                                new NotBlank(),
                                new Type(array(
                                    'type' => 'Zorbus\BannerBundle\Entity\Banner'
                                ))
                            )
                        ))
                        ->add('name', 'text', array(
                            'required' => true,
                            'constraints' => array(
                                new NotBlank()
                            )
                        ))
                        ->add('lang', 'language', array('preferred_choices' => array('pt_PT', 'en')))
                        ->add('theme', 'choice', array(
                            'choices' => $this->getThemes(),
                            'attr' => array('class' => 'span5 select2'),
                            'constraints' => array(
                                new NotBlank()
                            )
                        ))
                        ->add('cache_ttl', 'integer', array(
                            'required' => false,
                            'attr' => array('class' => 'span2'),
                            'constraints' => new Min(array('limit' => 0))
                        ))
                        ->add('enabled', 'checkbox', array('required' => false))
        ;
    }

    public function getBlockEntity(array $data, BlockEntity $block = null)
    {
        $block = null === $block ? new BlockEntity() : $block;

        $block->setService($this->getService());
        $block->setCategory('Banner');
        $block->setParameters(json_encode(array('banner_id' => $data['banner']->getId())));
        $block->setName($data['name']);
        $block->setLang($data['lang']);
        $block->setTheme($data['theme']);
        $block->setEnabled((boolean) $data['enabled']);
        $block->setCacheTtl($data['cache_ttl']);

        return $block;
    }

    public function render(BlockEntity $block, $page = null, $request = null)
    {
        if ($block->getService() != $this->getService())
        {
            throw new \InvalidArgumentException('Block service not supported');
        }

        $response = $this->httpKernel->forward($block->getTheme(), array('block' => $block));

        return $response;
    }

}