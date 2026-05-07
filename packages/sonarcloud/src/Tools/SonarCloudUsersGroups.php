<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Lists the groups a user belongs to. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/users/groups.
 */
class SonarCloudUsersGroups extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_users_groups';
    protected const DESCRIPTION = 'Lists the groups a user belongs to. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: GET /api/users/groups.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'A user login',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
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
      'organization' => 'organization',
      'p' => 'p',
      'ps' => 'ps',
      'q' => 'q',
      'selected' => 'selected',
    );
}
