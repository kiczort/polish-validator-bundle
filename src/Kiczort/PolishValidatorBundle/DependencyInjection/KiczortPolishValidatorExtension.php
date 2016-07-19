<?php

/*
 * This file is part of the Polish Validator Bundle package.
 *
 * (c) Grzegorz Koziński
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kiczort\PolishValidatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class KiczortPolishValidatorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $class_info = new \ReflectionClass($this);
        $dir = dirname($class_info->getFileName());

        $loader = new Loader\YamlFileLoader($container, new FileLocator($dir . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
