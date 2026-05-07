<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a project all its sub-components keys. Requires 'Administer' permission on the project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/projects/update_key.
 */
class SonarQubeProjectsUpdateKey extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_update_key';
    protected const DESCRIPTION = 'Update a project all its sub-components keys. Requires \'Administer\' permission on the project.

Official SonarQube Web API endpoint: POST /api/projects/update_key.';
    protected const PARAMETERS = array (
      'from' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'New project key',
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
