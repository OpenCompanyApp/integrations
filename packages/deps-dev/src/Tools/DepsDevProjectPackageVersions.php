<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve package versions built from a source project.
 */
class DepsDevProjectPackageVersions extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_project_package_versions';
    protected const DESCRIPTION = 'Retrieve known package versions built from a source project.';
    protected const METHOD = 'projectPackageVersions';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID such as github.com/facebook/react.'],
    ];
}
