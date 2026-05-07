<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a branch of an application selected in a portfolio. Requires 'Administrator' permission on the portfolio and 'Browse' permission for the application..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/views/add_application_branch.
 */
class SonarQubeViewsAddApplicationBranch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_views_add_application_branch';
    protected const DESCRIPTION = 'Add a branch of an application selected in a portfolio. Requires \'Administrator\' permission on the portfolio and \'Browse\' permission for the application.

Official SonarQube Web API endpoint: POST /api/views/add_application_branch.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Key of the application',
        'required' => true,
      ),
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
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/views/add_application_branch';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'branch' => 'branch',
      'key' => 'key',
    );
}
