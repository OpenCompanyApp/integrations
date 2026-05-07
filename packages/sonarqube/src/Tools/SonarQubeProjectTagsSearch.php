<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search tags.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_tags/search.
 */
class SonarQubeProjectTagsSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_tags_search';
    protected const DESCRIPTION = 'Search tags

Official SonarQube Web API endpoint: GET /api/project_tags/search.';
    protected const PARAMETERS = array (
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
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
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
    );
}
