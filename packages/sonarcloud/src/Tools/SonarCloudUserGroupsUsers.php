<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Search for users with membership information with respect to a group. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/user_groups/users.
 */
class SonarCloudUserGroupsUsers extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_users';
    protected const DESCRIPTION = 'Search for users with membership information with respect to a group. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: GET /api/user_groups/users.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Group id',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Group name',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization',
        'required' => false,
      ),
      'p' => array (
        'type' => 'string',
        'description' => '1-based page number',
        'required' => false,
      ),
      'ps' => array (
        'type' => 'string',
        'description' => 'Page size. Must be greater than 0.',
        'required' => false,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to names or logins that contain the supplied string.',
        'required' => false,
      ),
      'selected' => array (
        'type' => 'string',
        'description' => 'Depending on the value, show only selected items (selected=selected), deselected items (selected=deselected), or all items with their selection status (selected=all).',
        'required' => false,
        'enum' => array (
          'all',
          'deselected',
          'selected',
        ),
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/user_groups/users';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'name' => 'name',
      'organization' => 'organization',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
