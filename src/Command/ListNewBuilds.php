<?php

namespace DvLab\DeploymentBuildsExecutorBundle\Command;

use DvLab\DeploymentBuildsExecutor\BuildsExecutor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListNewBuilds extends Command
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
            ->setName('dv_lab:deployment_builds_executor:list-new-builds')
            ->setDescription('Display new build files');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $builds = $this->buildsExecutor->getNewBuilds();

        if (!count($builds)) {
            $output->writeln('<comment>No new builds found</comment>');
        } else {
            $output->writeln(sprintf('<info>%d new build(s) found</info>', count($builds)));
            $output->writeln($builds);
        }
    }

} 
