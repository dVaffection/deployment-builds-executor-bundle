<?php

namespace DvLab\DeploymentBuildsExecutorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use DvLab\DeploymentBuildsExecutorBundle\DependencyInjection\DvLabDeploymentBuildsExecutor;

class DvLabDeploymentBuildsExecutorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function load()
    {
        $configs          = array(
            array(
                'builds-dir'            => 'builds/directory',
                'latest-build-filename' => 'builds/directory/latest-build',
            ),
        );
        $containerBuilder = new ContainerBuilder();

        $ext = new DvLabDeploymentBuildsExecutor();
        $ext->load($configs, $containerBuilder);


        $this->assertTrue($containerBuilder->hasParameter('deployment_builds_executor.builds-dir'));
        $this->assertSame('builds/directory', $containerBuilder->getParameter('deployment_builds_executor.builds-dir'));
        $this->assertTrue($containerBuilder->hasParameter('deployment_builds_executor.latest-build-filename'));
        $this->assertSame(
            'builds/directory/latest-build',
            $containerBuilder->getParameter('deployment_builds_executor.latest-build-filename')
        );
    }
}
