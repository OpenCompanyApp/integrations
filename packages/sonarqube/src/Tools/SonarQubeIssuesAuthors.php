<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search SCM accounts which match a given query. Requires authentication. When issue indexing is in progress returns 503 service unavailable HTTP code..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/issues/authors.
 */
class SonarQubeIssuesAuthors extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_issues_authors';
    protected const DESCRIPTION = 'Search SCM accounts which match a given query. Requires authentication. When issue indexing is in progress returns 503 service unavailable HTTP code.

Official SonarQube Web API endpoint: GET /api/issues/authors.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 100',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to authors that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/issues/authors';
    protected const PARAM_MAP = array (
      'project' => 'project',
      'ps' => 'ps',
      'q' => 'q',
    );
}
