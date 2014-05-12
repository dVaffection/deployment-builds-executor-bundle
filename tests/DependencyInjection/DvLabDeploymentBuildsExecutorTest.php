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
                'builds_dir'            => 'builds/directory',
                'latest_build_filename' => 'builds/directory/latest-build',
            ),
        );
        $containerBuilder = new ContainerBuilder();

        $ext = new DvLabDeploymentBuildsExecutor();
        $ext->load($configs, $containerBuilder);


        $this->assertTrue($containerBuilder->hasParameter('deployment_builds_executor.builds_dir'));
        $this->assertSame('builds/directory', $containerBuilder->getParameter('deployment_builds_executor.builds_dir'));
        $this->assertTrue($containerBuilder->hasParameter('deployment_builds_executor.latest_build_filename'));
        $this->assertSame(
            'builds/directory/latest-build',
            $containerBuilder->getParameter('deployment_builds_executor.latest_build_filename')
        );
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function validateEmptyConfig()
    {
        $containerBuilder = new ContainerBuilder();

        $ext = new DvLabDeploymentBuildsExecutor();
        $ext->load(array(), $containerBuilder);
    }

    /**
     * @test
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function validateConfigEmptyValues()
    {
        $configs          = array(
            array(
                'builds_dir'            => '',
                'latest_build_filename' => '',
            ),
        );
        $containerBuilder = new ContainerBuilder();

        $ext = new DvLabDeploymentBuildsExecutor();
        $ext->load($configs, $containerBuilder);
    }

}
