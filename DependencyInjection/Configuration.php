<?php

namespace Anh\SapeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('anh_sape');

        $rootNode->children()
            ->scalarNode('user')->isRequired()->end()
            ->arrayNode('client_options')
                ->defaultValue(array('charset' => 'utf8'))
                ->prototype('scalar')
            ->end()
        ;

        return $treeBuilder;
    }
}
