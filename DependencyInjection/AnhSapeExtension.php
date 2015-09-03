<?php

namespace Anh\SapeBundle\DependencyInjection;

use Anh\SapeBundle\Sape\SapeClient;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AnhSapeExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setDefinition('anh_sape.sape_client', new Definition(
            'Anh\SapeBundle\Sape\SapeClient',
            array(
                $config['user'],
                $container->getParameter('kernel.cache_dir') . '/sape',
                $config['client_options']
            )
        ));
    }
}
