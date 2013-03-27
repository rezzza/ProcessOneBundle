<?php

namespace Rezzza\ProcessOneBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

/**
 * RezzzaProcessOneExtension 
 *
 * @uses Extension
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class RezzzaProcessOneExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $config    = $processor->processConfiguration(new Configuration(), $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('transport.xml');


        foreach ($config['connections'] as $connection => $data) {
            $metadata = new Definition('Rezzza\ProcessOneBundle\Api\Metadata');
            $metadata->setArguments(array(
                $data['host'],
                $data['publish']['key'],
                $data['publish']['secret'],
                $data['publish']['expire'],
            ));

            $transport  = $data['transport'];
            if ($transport == 'guzzle' && !class_exists('\Guzzle\Http\Client')) {
                throw new \RuntimeException('Guzzle library is not installed/autoloaded');
            }

            $definition = new Definition('Rezzza\ProcessOneBundle\Api\Connection');
            $definition->addArgument($metadata);
            $definition->addArgument(new Reference(sprintf('rezzza.process_one.transport.%s', $transport)));

            $container->setDefinition(sprintf('rezzza.process_one.%s.connection', $connection), $definition);
        }
    }
}
