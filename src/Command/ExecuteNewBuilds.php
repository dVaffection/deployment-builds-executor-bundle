<?php

namespace DvLab\DeploymentBuildsExecutorBundle\Command;

use DvLab\DeploymentBuildsExecutor\BuildsExecutor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExecuteNewBuilds extends Command
{

    /**
     * @var BuildsExecutor
     */
    private $buildsExecutor;

    public function __construct(BuildsExecutor $buildsExecutor)
    {
        $this->buildsExecutor = $buildsExecutor;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('deployment_builds_executor:execute-new-builds')
            ->setDescription('Execute new build files');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $builds = $this->buildsExecutor->getNewBuilds();
        if (count($builds)) {
            $result = $this->buildsExecutor->executeNewBuilds();

            if ($result->getReturnCode() > 0) {
                $output->writeln('<error>An error occurred during a build execution. Stop further execution</error>');
            } else {
                foreach ($result->getOutput() as $buildOutput) {
                    $output->writeln($buildOutput);
                }
            }
        } else {
            $output->writeln('<comment>No new builds found</comment>');
        }
    }

} 
