<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a pull request. Requires 'Administer' rights on the specified project..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/project_pull_requests/delete.
 */
class SonarQubeProjectPullRequestsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_pull_requests_delete';
    protected const DESCRIPTION = 'Delete a pull request. Requires \'Administer\' rights on the specified project.

Official SonarQube Web API endpoint: POST /api/project_pull_requests/delete.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/project_pull_requests/delete';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'pullRequest' => 'pull_request',
    );
}
