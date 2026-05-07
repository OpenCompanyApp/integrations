<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search SCM accounts which match a given query. Requires authentication..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/issues/authors.
 */
class SonarCloudIssuesAuthors extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_issues_authors';
    protected const DESCRIPTION = 'Search SCM accounts which match a given query. Requires authentication.

Official SonarCloud Web API endpoint: GET /api/issues/authors.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => true,
      ),
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
      'organization' => 'organization',
      'project' => 'project',
      'ps' => 'ps',
      'q' => 'q',
    );
}
