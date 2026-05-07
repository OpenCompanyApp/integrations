<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve source project metadata.
 */
class DepsDevProject extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_project';
    protected const DESCRIPTION = 'Retrieve deps.dev project metadata for a source repository identifier.';
    protected const METHOD = 'project';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID such as github.com/facebook/react.'],
    ];
}
