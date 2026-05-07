<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve declared dependency requirements for one package version.
 */
class DepsDevRequirements extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_requirements';
    protected const DESCRIPTION = 'Retrieve system-specific declared dependency requirements for one package version.';
    protected const METHOD = 'requirements';
    protected const REQUIRED = ['system', 'name', 'version'];
    protected const PARAMETERS = [
        'system' => ['type' => 'string', 'required' => true, 'description' => 'Package system.', 'enum' => ['GO', 'RUBYGEMS', 'NPM', 'CARGO', 'MAVEN', 'PYPI', 'NUGET']],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Package name.'],
        'version' => ['type' => 'string', 'required' => true, 'description' => 'Package version.'],
    ];
}
