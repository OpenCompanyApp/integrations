<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a branch on a given application. Requires 'Administrator' permission on the application.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/applications/delete_branch.
 */
class SonarQubeApplicationsDeleteBranch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_applications_delete_branch';
    protected const DESCRIPTION = 'Delete a branch on a given application. Requires \'Administrator\' permission on the application

Official SonarQube Web API endpoint: POST /api/applications/delete_branch.';
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
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/applications/delete_branch';
    protected const PARAM_MAP = array (
      'application' => 'application',
      'branch' => 'branch',
    );
}
