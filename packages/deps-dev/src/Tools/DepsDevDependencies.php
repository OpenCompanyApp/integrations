<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve the resolved dependency graph for one package version.
 */
class DepsDevDependencies extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_dependencies';
    protected const DESCRIPTION = 'Retrieve the resolved dependency graph for one package version where deps.dev supports dependency resolution.';
    protected const METHOD = 'dependencies';
    protected const REQUIRED = ['system', 'name', 'version'];
    protected const PARAMETERS = [
        'system' => ['type' => 'string', 'required' => true, 'description' => 'Package system.', 'enum' => ['NPM', 'CARGO', 'MAVEN', 'PYPI']],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Package name.'],
        'version' => ['type' => 'string', 'required' => true, 'description' => 'Package version.'],
    ];
}
