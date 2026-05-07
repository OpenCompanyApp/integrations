<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a branch of a project selected in a portfolio. Requires 'Administrator' permission on the portfolio and 'Browse' permission for the project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/add_project_branch.
 */
class SonarQubeViewsAddProjectBranch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_add_project_branch';
    protected const DESCRIPTION = 'Add a branch of a project selected in a portfolio. Requires \'Administrator\' permission on the portfolio and \'Browse\' permission for the project.

Official SonarQube Web API endpoint: POST /api/views/add_project_branch.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Key of the branch',
        'required' => true,
      ),
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
    protected const PATH = '/api/views/add_project_branch';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'key' => 'key',
      'project' => 'project',
    );
}
