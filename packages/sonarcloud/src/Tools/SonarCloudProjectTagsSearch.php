<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search tags.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/project_tags/search.
 */
class SonarCloudProjectTagsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_project_tags_search';
    protected const DESCRIPTION = 'Search tags

Official SonarCloud Web API endpoint: GET /api/project_tags/search.';
    protected const PARAMETERS = array (
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 100',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to tags that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_tags/search';
    protected const PARAM_MAP = array (
      'ps' => 'ps',
      'q' => 'q',
    );
}
