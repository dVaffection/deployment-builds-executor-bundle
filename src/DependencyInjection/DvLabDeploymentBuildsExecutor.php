<?php

namespace DvLab\DeploymentBuildsExecutorBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class DvLabDeploymentBuildsExecutor extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);


        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        if (isset($config['builds_dir'])) {
            $container->setParameter('deployment_builds_executor.builds_dir', $config['builds_dir']);
        }
        if (isset($config['latest_build_filename'])) {
            $container->setParameter(
                'deployment_builds_executor.latest_build_filename', $config['latest_build_filename']
            );
        }

        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'deployment_builds_executor';
    }

}
