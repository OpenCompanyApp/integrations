<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Lists the groups a user belongs to. Requires Administer System permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/users/groups.
 */
class SonarQubeUsersGroups extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_groups';
    protected const DESCRIPTION = 'Lists the groups a user belongs to. Requires Administer System permission.

Official SonarQube Web API endpoint: GET /api/users/groups.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'A user login',
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
        'description' => 'Limit search to group names that contain the supplied string.',
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
    protected const PATH = '/api/users/groups';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
