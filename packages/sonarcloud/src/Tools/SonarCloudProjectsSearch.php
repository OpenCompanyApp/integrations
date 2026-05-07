<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for projects to administrate them. Requires 'System Administrator' permission.
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/projects/search.
 */
class SonarCloudProjectsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_search';
    protected const DESCRIPTION = 'Search for projects to administrate them. Requires \'System Administrator\' permission

Official SonarCloud Web API endpoint: GET /api/projects/search.';
    protected const PARAMETERS = array (
      'analyzed_before' => array (
        'type' => 'string',
        'description' => 'Filter the projects for which last analysis is older than the given date (exclusive). Either a date (server timezone) or datetime can be provided.',
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
      'organization' => array (
        'type' => 'string',
        'description' => 'The key of the organization',
        'required' => true,
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
        'description' => 'No longer used',
        'required' => false,
        'enum' => array (
          'TRK',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/projects/search';
    protected const PARAM_MAP = array (
      'analyzedBefore' => 'analyzed_before',
      'onProvisionedOnly' => 'on_provisioned_only',
      'organization' => 'organization',
      'p' => 'p',
      'projects' => 'projects',
      'ps' => 'ps',
      'q' => 'q',
      'qualifiers' => 'qualifiers',
    );
}
