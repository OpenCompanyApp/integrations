<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for projects or views to administrate them. - The response field 'lastAnalysisDate' takes into account the analysis of all branches and pull requests, not only the main branch.; - The response field 'revision' takes into account the analysis of the main branch only.; Requires 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/projects/search.
 */
class SonarQubeProjectsSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_projects_search';
    protected const DESCRIPTION = 'Search for projects or views to administrate them. - The response field \'lastAnalysisDate\' takes into account the analysis of all branches and pull requests, not only the main branch.; - The response field \'revision\' takes into account the analysis of the main branch only.; Requires \'Administer System\' permission

Official SonarQube Web API endpoint: GET /api/projects/search.';
    protected const PARAMETERS = array (
      'analyzed_before' => array (
        'type' => 'string',
        'description' => 'Filter the projects for which the last analysis of all branches are older than the given date (exclusive). Either a date (server timezone) or datetime can be provided.',
        'required' => false,
      ),
      'on_provisioned_only' => array (
        'type' => 'string',
        'description' => 'Filter the projects that are provisioned',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'projects' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of project keys',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to: - component names that contain the supplied string; - component keys that contain the supplied string;',
        'required' => false,
      ),
      'qualifiers' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of component qualifiers. Filter the results with the specified qualifiers',
        'required' => false,
        'enum' => array (
          'TRK',
          'VW',
          'APP',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/projects/search';
    protected const PARAM_MAP = array (
      'analyzedBefore' => 'analyzed_before',
      'onProvisionedOnly' => 'on_provisioned_only',
      'p' => 'p',
      'projects' => 'projects',
      'ps' => 'ps',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
    );
}
