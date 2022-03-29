<?php

/**
 * This file is part of Vtt Bundle for Contao
 *
 * @package     tdoescher/vtt-bundle
 * @author      Torben Döscher <mail@tdoescher.de>
 * @license     LGPL
 * @copyright   tdoescher.de - WEB und IT <https://tdoescher.de>
 */

namespace tdoescher\VttBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class VttExtension extends Extension
{ 
    public function load(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator( __DIR__ . '/../Resources/config'));
        $loader->load('listener.yaml');
    }
}
