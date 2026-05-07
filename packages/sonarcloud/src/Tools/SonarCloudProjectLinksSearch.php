<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List links of a project. The 'projectId' or 'projectKey' must be provided. Requires one of the following permissions:- 'Administer' rights on the specified project; - 'Browse' on the specified project;.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_links/search.
 */
class SonarCloudProjectLinksSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_links_search';
    protected const DESCRIPTION = 'List links of a project. The \'projectId\' or \'projectKey\' must be provided. Requires one of the following permissions:- \'Administer\' rights on the specified project; - \'Browse\' on the specified project;

Official SonarCloud Web API endpoint: GET /api/project_links/search.';
    protected const PARAMETERS = array (
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project Id',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project Key',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_links/search';
    protected const PARAM_MAP = array (
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
