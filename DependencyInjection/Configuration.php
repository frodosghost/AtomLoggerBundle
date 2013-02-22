<?php

namespace Atom\LoggerBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('atom_logger');

        $rootNode
            ->children()
                ->scalarNode('api_key')
                    ->info('Set the API key for the sites configuration.')
                    ->end()
                ->scalarNode('uri')
                    ->info('URL specified to connect to the ATOM Logger service.')
                    ->example('http://atomlogger.com/api/')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
