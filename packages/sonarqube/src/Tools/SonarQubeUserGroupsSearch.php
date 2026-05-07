<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for user groups. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/user_groups/search.
 */
class SonarQubeUserGroupsSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_search';
    protected const DESCRIPTION = 'Search for user groups. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: GET /api/user_groups/search.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'f' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the fields to be returned in response. All the fields are returned by default.',
        'required' => false,
        'enum' => array (
          'name',
          'description',
          'membersCount',
          'managed',
        ),
      ),
      'managed' => array (
        'type' => 'string',
        'description' => 'Return managed or non-managed groups. Only available for managed instances, throws for non-managed instances.',
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
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0 and less or equal than 500',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to names that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/user_groups/search';
    protected const PARAM_MAP = array (
      'f' => 'f',
      'managed' => 'managed',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
    );
}
