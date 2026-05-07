<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List tags matching a given query.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/issues/tags.
 */
class SonarQubeIssuesTags extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_tags';
    protected const DESCRIPTION = 'List tags matching a given query

Official SonarQube Web API endpoint: GET /api/issues/tags.';
    protected const PARAMETERS = array (
      'all' => array (
        'type' => 'string',
        'description' => 'Indicator to search for all tags or only for tags in the main branch of a project',
        'required' => false,
        'enum' => array (
          'true',
          'false',
        ),
      ),
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to tags that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/issues/tags';
    protected const PARAM_MAP = array (
      'all' => 'all',
      'branch' => 'branch',
      'project' => 'project',
      'ps' => 'ps',
      'q' => 'q',
    );
}
