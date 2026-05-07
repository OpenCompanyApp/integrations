<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Add a user to a group. 'id' or 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_groups/add_user.
 */
class SonarCloudUserGroupsAddUser extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_add_user';
    protected const DESCRIPTION = 'Add a user to a group. \'id\' or \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: POST /api/user_groups/add_user.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Group id',
        'required' => false,
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
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
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_groups/add_user';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'login' => 'login',
      'name' => 'name',
      'organization' => 'organization',
    );
}
