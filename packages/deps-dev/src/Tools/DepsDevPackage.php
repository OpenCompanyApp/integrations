<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve package metadata and available versions.
 */
class DepsDevPackage extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_package';
    protected const DESCRIPTION = 'Retrieve deps.dev package metadata and available versions for a package system and name.';
    protected const METHOD = 'package';
    protected const REQUIRED = ['system', 'name'];
    protected const PARAMETERS = [
        'system' => ['type' => 'string', 'required' => true, 'description' => 'Package system.', 'enum' => ['GO', 'RUBYGEMS', 'NPM', 'CARGO', 'MAVEN', 'PYPI', 'NUGET']],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Package name, such as react or @colors/colors.'],
    ];
}
