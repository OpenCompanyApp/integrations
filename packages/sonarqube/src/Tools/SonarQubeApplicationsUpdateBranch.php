<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a branch on a given application. Requires 'Administrator' permission on the application and 'Browse' permission on its child projects.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/update_branch.
 */
class SonarQubeApplicationsUpdateBranch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_update_branch';
    protected const DESCRIPTION = 'Update a branch on a given application. Requires \'Administrator\' permission on the application and \'Browse\' permission on its child projects

Official SonarQube Web API endpoint: POST /api/applications/update_branch.';
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
      'name' => array (
        'type' => 'string',
        'description' => 'New branch name',
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
    protected const PATH = '/api/applications/update_branch';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'branch' => 'branch',
      'name' => 'name',
      'project' => 'project',
      'projectBranch' => 'project_branch',
    );
}
