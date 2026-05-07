<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a new branch on a given application. Requires 'Administrator' permission on the application and 'Browse' permission on its child projects.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/create_branch.
 */
class SonarQubeApplicationsCreateBranch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_create_branch';
    protected const DESCRIPTION = 'Create a new branch on a given application. Requires \'Administrator\' permission on the application and \'Browse\' permission on its child projects

Official SonarQube Web API endpoint: POST /api/applications/create_branch.';
    protected const PARAMETERS = array (
      'application' => array (
        'type' => 'string',
        'description' => 'Application key',
        'required' => true,
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch name',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project keys. To set several values, the parameter must be called once for each value.',
        'required' => true,
      ),
      'project_branch' => array (
        'type' => 'string',
        'description' => 'Project branches. To set main branch, provide an empty value. To set several values, the parameter must be called once for each value.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/create_branch';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'branch' => 'branch',
      'project' => 'project',
      'projectBranch' => 'project_branch',
    );
}
