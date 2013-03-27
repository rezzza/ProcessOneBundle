<?php

namespace Rezzza\ProcessOneBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration 
 *
 * @uses ConfigurationInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rezzza_process_one');

        $rootNode
            ->children()
                ->arrayNode('connections')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('host')->cannotBeEmpty()->end()
                            ->arrayNode('publish')
                                ->children()
                                    ->scalarNode('key')->cannotBeEmpty()->end()
                                    ->scalarNode('secret')->cannotBeEmpty()->end()
                                    ->integerNode('expire')->defaultValue(10)->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
