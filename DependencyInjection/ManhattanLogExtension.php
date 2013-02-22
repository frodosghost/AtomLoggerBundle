<?php

namespace Manhattan\LogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ManhattanLogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (!isset($config['api_key'])) {
            throw new \InvalidArgumentException('AtomLogger requires the "api_key" option to be set');
        }
        if (!isset($config['uri'])) {
            throw new \InvalidArgumentException('AtomLogger requires "uri" option to be set');
        }

        $container->setParameter('atom.logger.configuration.api_key', $config['api_key']);
        $container->setParameter('atom.logger.configuration.uri', $config['uri']);
    }
}
