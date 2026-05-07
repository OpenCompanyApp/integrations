<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update a project or module key and all its sub-components keys. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/update_key.
 */
class SonarCloudProjectsUpdateKey extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_update_key';
    protected const DESCRIPTION = 'Update a project or module key and all its sub-components keys. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/projects/update_key.';
    protected const PARAMETERS = array (
      'from' => array (
        'type' => 'string',
        'description' => 'Project or module key',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'New component key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/update_key';
    protected const PARAM_MAP = array (
      'from' => 'from',
      'to' => 'to',
    );
}
