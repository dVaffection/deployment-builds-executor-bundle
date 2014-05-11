<?php

namespace DvLab\DeploymentBuildsExecutorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use DvLab\DeploymentBuildsExecutorBundle\DependencyInjection\DvLabDeploymentBuildsExecutorExtension;

class DvLabDeploymentBuildsExecutorBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // register extensions that do not follow the conventions manually
        $container->registerExtension(new DvLabDeploymentBuildsExecutorExtension());
    }

} 
