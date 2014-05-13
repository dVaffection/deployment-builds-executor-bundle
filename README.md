# Symfony DeploymentBuildsExecutorBundle

The bundle integrates the [Build files executor library](https://github.com/dVaffection/deployment-builds-executor)

[![Build Status](https://travis-ci.org/dVaffection/deployment-builds-executor-bundle.svg?branch=master)](https://travis-ci.org/dVaffection/deployment-builds-executor-bundle)

Bundle comes with 2 console commands:
- **deployment_builds_executor:execute-new-builds** -- Execute new build files
- **deployment_builds_executor:list-new-builds**    -- Display new build files

## Installation

### Download
Bundle still hasn't reached stable version so keep in mind that **backward-incompatible** changes can be made for a **MINOR** version,
that's why I strongly recommend to update only **PATCH** version. Add to your `composer.json`
```
{
    "require": {
        "dv-affection/deployment-builds-executor-bundle": "~0.1.0"
    }
}
```
Update bundle via composer `php composer.phar update dv-affection/deployment-builds-executor-bundle`

### Enable
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new DvLab\DeploymentBuildsExecutorBundle\DvLabDeploymentBuildsExecutorBundle(),
    );
}
```


### Configure
```
deployment_builds_executor:
    builds_dir:             "%kernel.root_dir%/../dev/builds"
    latest_build_filename:  "%kernel.root_dir%/../dev/builds/latest-build"
```
**NOTICE:** `latest_build_filename` is assumed to be local to every environment (likely ignored by git)
