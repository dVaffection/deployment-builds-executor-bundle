<?php

namespace DvLab\DeploymentBuildsExecutorBundle\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use DvLab\DeploymentBuildsExecutorBundle\Command\ListNewBuilds;

class ListNewBuildsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function noNewBuilds()
    {
        $buildsExecutor = $this->getBuildsExecutorMock(array());

        $application = new Application();
        $application->add(new ListNewBuilds($buildsExecutor));

        $command       = $application->find('dv_lab:deployment_builds_executor:list-new-builds');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $actual   = trim($commandTester->getDisplay());
        $expected = 'No new builds found';
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function newBuildsFound()
    {
        $builds         = array(
            '123456',
            '123457',
        );
        $buildsExecutor = $this->getBuildsExecutorMock($builds);

        $application = new Application();
        $application->add(new ListNewBuilds($buildsExecutor));

        $command       = $application->find('dv_lab:deployment_builds_executor:list-new-builds');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $actual   = trim($commandTester->getDisplay());
        $expected = "2 new build(s) found\n123456\n123457";
        $this->assertSame($expected, $actual);
    }

    /**
     * @param mixed $returnValue
     * @return \DvLab\DeploymentBuildsExecutor\BuildsExecutor
     */
    private function getBuildsExecutorMock($returnValue)
    {
        $buildsExecutor = $this
            ->getMockBuilder('DvLab\DeploymentBuildsExecutor\BuildsExecutor')
            ->disableOriginalConstructor()
            ->setMethods(array('getNewBuilds'))
            ->getMock();

        $buildsExecutor
            ->expects($this->once())
            ->method('getNewBuilds')
            ->willReturn($returnValue);

        return $buildsExecutor;
    }

} 
