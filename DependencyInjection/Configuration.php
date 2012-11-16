<?php

namespace Zorbus\BannerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('zorbus_banner');

        $rootNode
            ->children()
                ->arrayNode('banner')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('themes')
                            ->defaultValue(array(
                                'ZorbusBannerBundle:Block:banner' => array('name' => 'Default')
                             ))
                            ->useAttributeAsKey('controller')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('name')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')
                                    ->defaultValue('Zorbus\BannerBundle\Admin\BannerAdmin')
                                ->end()
                                ->scalarNode('entity')
                                    ->defaultValue('Zorbus\BannerBundle\Entity\Banner')
                                ->end()
                                ->scalarNode('controller')
                                    ->defaultValue('SonataAdminBundle:CRUD')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
