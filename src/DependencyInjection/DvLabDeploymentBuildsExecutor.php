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
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        foreach ($configs as $subConfig) {
            if (isset($subConfig['builds-dir'])) {
                $container->setParameter('deployment_builds_executor.builds-dir', $subConfig['builds-dir']);
            }
            if (isset($subConfig['latest-build-filename'])) {
                $container->setParameter(
                    'deployment_builds_executor.latest-build-filename', $subConfig['latest-build-filename']
                );
            }
        }

        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'deployment_builds_executor';
    }

}
