<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a pull request. Requires 'Administer' rights on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/project_pull_requests/delete.
 */
class SonarCloudProjectPullRequestsDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_pull_requests_delete';
    protected const DESCRIPTION = 'Delete a pull request. Requires \'Administer\' rights on the specified project.

Official SonarCloud Web API endpoint: POST /api/project_pull_requests/delete.';
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
