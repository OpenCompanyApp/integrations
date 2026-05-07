<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Search for users with membership information with respect to a group. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/user_groups/users.
 */
class SonarQubeUserGroupsUsers extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_users';
    protected const DESCRIPTION = 'Search for users with membership information with respect to a group. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: GET /api/user_groups/users.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Group name',
        'required' => true,
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
      'name' => 'name',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
