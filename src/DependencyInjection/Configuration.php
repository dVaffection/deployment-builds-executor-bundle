<?php

namespace DvLab\DeploymentBuildsExecutorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('dv_lab_deployment_builds_executor');

        $rootNode
            ->children()
            ->scalarNode('builds-dir')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('latest-build-filename')->isRequired()->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }

} 
