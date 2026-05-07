<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a project to a portfolio. Requires 'Administrator' permission on the portfolio and 'Browse' permission for adding project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/add_project.
 */
class SonarQubeViewsAddProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_add_project';
    protected const DESCRIPTION = 'Add a project to a portfolio. Requires \'Administrator\' permission on the portfolio and \'Browse\' permission for adding project.

Official SonarQube Web API endpoint: POST /api/views/add_project.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Key of the portfolio',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Key of the project',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/add_project';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'project' => 'project',
    );
}
