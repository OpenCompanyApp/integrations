<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a project from a portfolio. Requires 'Administrator' permission on the portfolio..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/remove_project.
 */
class SonarQubeViewsRemoveProject extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_remove_project';
    protected const DESCRIPTION = 'Remove a project from a portfolio. Requires \'Administrator\' permission on the portfolio.

Official SonarQube Web API endpoint: POST /api/views/remove_project.';
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
    protected const PATH = '/api/views/remove_project';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'project' => 'project',
    );
}
