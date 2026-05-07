<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List the pull requests of a project. One of the following permissions is required: - 'Browse' rights on the specified project; - 'Execute Analysis' rights on the specified project;.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_pull_requests/list.
 */
class SonarCloudProjectPullRequestsList extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_pull_requests_list';
    protected const DESCRIPTION = 'List the pull requests of a project. One of the following permissions is required: - \'Browse\' rights on the specified project; - \'Execute Analysis\' rights on the specified project;

Official SonarCloud Web API endpoint: GET /api/project_pull_requests/list.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_pull_requests/list';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
