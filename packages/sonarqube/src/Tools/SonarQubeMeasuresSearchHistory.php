<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search measures history of a component. Measures are ordered chronologically. Pagination applies to the number of measures for each metric. Requires the following permission: 'Browse' on the specified component. For applications, it also requires 'Browse' permission on its child projects..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/measures/search_history.
 */
class SonarQubeMeasuresSearchHistory extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_measures_search_history';
    protected const DESCRIPTION = 'Search measures history of a component. Measures are ordered chronologically. Pagination applies to the number of measures for each metric. Requires the following permission: \'Browse\' on the specified component. For applications, it also requires \'Browse\' permission on its child projects.

Official SonarQube Web API endpoint: GET /api/measures/search_history.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key. Not available in the community edition.',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => true,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Filter measures created after the given date (inclusive). Either a date (server timezone) or datetime can be provided',
        'required' => false,
      ),
      'metrics' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of metric keys',
        'required' => true,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 1000',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id. Not available in the community edition.',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Filter measures created before the given date (inclusive). Either a date (server timezone) or datetime can be provided',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/measures/search_history';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'component' => 'component',
      'from' => 'from',
      'metrics' => 'metrics',
      'p' => 'p',
      'ps' => 'ps',
      'pullRequest' => 'pull_request',
      'to' => 'to',
    );
}
