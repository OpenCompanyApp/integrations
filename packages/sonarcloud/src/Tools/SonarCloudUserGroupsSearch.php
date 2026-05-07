<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for user groups. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/user_groups/search.
 */
class SonarCloudUserGroupsSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_search';
    protected const DESCRIPTION = 'Search for user groups. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: GET /api/user_groups/search.';
    protected const PARAMETERS = array (
      'f' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of the fields to be returned in response. All the fields are returned by default.',
        'required' => false,
        'enum' => array (
          'name',
          'description',
          'membersCount',
        ),
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization',
        'required' => true,
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
      'organization' => 'organization',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
    );
}
