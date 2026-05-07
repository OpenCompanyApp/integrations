<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a project. Requires 'Administer System' permission or 'Administer' permission on the project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/delete.
 */
class SonarCloudProjectsDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_delete';
    protected const DESCRIPTION = 'Delete a project. Requires \'Administer System\' permission or \'Administer\' permission on the project.

Official SonarCloud Web API endpoint: POST /api/projects/delete.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/delete';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
