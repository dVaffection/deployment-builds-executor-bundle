# Symfony DeploymentBuildsExecutorBundle

The bundle integrates the [Build files executor library](https://github.com/dVaffection/deployment-builds-executor)

[![Build Status](https://travis-ci.org/dVaffection/deployment-builds-executor-bundle.svg?branch=master)](https://travis-ci.org/dVaffection/deployment-builds-executor-bundle)

Bundle comes with 2 console commands:
- **deployment_builds_executor:execute-new-builds** -- Execute new build files
- **deployment_builds_executor:list-new-builds**    -- Display new build files

## Configuration
```
deployment_builds_executor:
    builds_dir:             "%kernel.root_dir%/../dev/builds"
    latest_build_filename:  "%kernel.root_dir%/../dev/builds/latest-build"
```
