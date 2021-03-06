<?php

/*
 * This file is part of The Atom Logger Bundle
 *
 * (c) James Rickard <james@frodosghost.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Atom\LoggerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AtomLoggerExtension extends Extension
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

        if (!isset($config['user']['public_key'])) {
            throw new \InvalidArgumentException('You must provide the "Public Key" for the AtomLogger User.');
        }
        if (!isset($config['user']['private_key'])) {
            throw new \InvalidArgumentException('You must provide the "Private Key" for the AtomLogger User.');
        }
        if (!isset($config['uri'])) {
            throw new \InvalidArgumentException('AtomLogger requires "uri" option to be set');
        }

        $container->setParameter('atom.logger.authentication.public_key', $config['user']['public_key']);
        $container->setParameter('atom.logger.authentication.private_key', $config['user']['private_key']);
        $container->setParameter('atom.logger.configuration.uri', $config['uri']);
    }
}
