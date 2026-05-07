<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a project. Requires 'Administer System' permission or 'Administer' permission on the project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/projects/delete.
 */
class SonarQubeProjectsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_delete';
    protected const DESCRIPTION = 'Delete a project. Requires \'Administer System\' permission or \'Administer\' permission on the project.

Official SonarQube Web API endpoint: POST /api/projects/delete.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/delete';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
