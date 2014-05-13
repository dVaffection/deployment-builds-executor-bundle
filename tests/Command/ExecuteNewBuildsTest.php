<?php

namespace DvLab\DeploymentBuildsExecutorBundle\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use DvLab\DeploymentBuildsExecutorBundle\Command\ExecuteNewBuilds;
use DvLab\DeploymentBuildsExecutor\Result;

class ExecuteNewBuildsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function errorDuringBuildExecution()
    {
        $result         = new Result(1, array());
        $buildsExecutor = $this->getBuildsExecutorMock($result);

        $application = new Application();
        $application->add(new ExecuteNewBuilds($buildsExecutor));

        $command       = $application->find('deployment_builds_executor:execute-new-builds');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $actual   = trim($commandTester->getDisplay());
        $expected = 'An error occurred during a build execution. Stop further execution';
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function successExecution()
    {
        $output         = array(
            array('success'),
            array('success'),
        );
        $result         = new Result(0, $output);
        $buildsExecutor = $this->getBuildsExecutorMock($result);

        $application = new Application();
        $application->add(new ExecuteNewBuilds($buildsExecutor));

        $command       = $application->find('deployment_builds_executor:execute-new-builds');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $actual   = trim($commandTester->getDisplay());
        $expected = "success\nsuccess";
        $this->assertSame($expected, $actual);
    }

    /**
     * @param Result $returnValue
     * @return \DvLab\DeploymentBuildsExecutor\BuildsExecutor
     */
    private function getBuildsExecutorMock(Result $returnValue)
    {
        $buildsExecutor = $this
            ->getMockBuilder('DvLab\DeploymentBuildsExecutor\BuildsExecutor')
            ->disableOriginalConstructor()
            ->setMethods(array('executeNewBuilds'))
            ->getMock();

        $buildsExecutor
            ->expects($this->once())
            ->method('executeNewBuilds')
            ->willReturn($returnValue);

        return $buildsExecutor;
    }

} 
