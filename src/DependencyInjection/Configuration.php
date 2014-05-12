<?php

namespace DvLab\DeploymentBuildsExecutorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('deployment_builds_executor');

        $rootNode
            ->children()
            ->scalarNode('builds_dir')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('latest_build_filename')->isRequired()->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }

} 
