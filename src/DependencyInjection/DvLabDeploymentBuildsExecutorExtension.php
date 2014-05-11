<?php

namespace DvLab\DeploymentBuildsExecutorBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class DvLabDeploymentBuildsExecutorExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        foreach ($configs as $subConfig) {
            if (isset($subConfig['builds-dir'])) {
                $container->setParameter('dv_lab_deployment_builds_executor.builds-dir', $subConfig['builds-dir']);
            }
            if (isset($subConfig['latest-build-filename'])) {
                $container->setParameter('dv_lab_deployment_builds_executor.latest-build-filename', $subConfig['latest-build-filename']);
            }
        }

        $loader->load('services.yml');

    }

}
