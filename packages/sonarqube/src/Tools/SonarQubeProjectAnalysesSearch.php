<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search a project analyses and attached events. Requires the following permission: 'Browse' on the specified project. For applications, it also requires 'Browse' permission on its child projects..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/project_analyses/search.
 */
class SonarQubeProjectAnalysesSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_project_analyses_search';
    protected const DESCRIPTION = 'Search a project analyses and attached events. Requires the following permission: \'Browse\' on the specified project. For applications, it also requires \'Browse\' permission on its child projects.

Official SonarQube Web API endpoint: GET /api/project_analyses/search.';
    protected const PARAMETERS = array (
      'category' => array (
        'type' => 'string',
        'description' => 'Event category. Filter analyses that have at least one event of the category specified.',
        'required' => false,
        'enum' => array (
          'VERSION',
          'OTHER',
          'QUALITY_PROFILE',
          'QUALITY_GATE',
          'DEFINITION_CHANGE',
          'ISSUE_DETECTION',
          'SQ_UPGRADE',
        ),
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Filter analyses created after the given date (inclusive). Either a date (server timezone) or datetime can be provided',
        'required' => false,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Filter analyses created before the given date (inclusive). Either a date (server timezone) or datetime can be provided',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/project_analyses/search';
    protected const PARAM_MAP = array (
      'category' => 'category',
      'from' => 'from',
      'p' => 'p',
      'project' => 'project',
      'ps' => 'ps',
      'to' => 'to',
    );
}
