<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve metadata for one package version.
 */
class DepsDevVersion extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_version';
    protected const DESCRIPTION = 'Retrieve deps.dev metadata for one package version, including licenses, advisories, links, attestations, and related projects.';
    protected const METHOD = 'version';
    protected const REQUIRED = ['system', 'name', 'version'];
    protected const PARAMETERS = [
        'system' => ['type' => 'string', 'required' => true, 'description' => 'Package system.', 'enum' => ['GO', 'RUBYGEMS', 'NPM', 'CARGO', 'MAVEN', 'PYPI', 'NUGET']],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Package name. Maven names use group:artifact form.'],
        'version' => ['type' => 'string', 'required' => true, 'description' => 'Package version.'],
    ];
}
