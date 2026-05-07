<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a user from a group. 'id' or 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_groups/remove_user.
 */
class SonarCloudUserGroupsRemoveUser extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_remove_user';
    protected const DESCRIPTION = 'Remove a user from a group. \'id\' or \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: POST /api/user_groups/remove_user.';
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
    protected const PATH = '/api/user_groups/remove_user';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'login' => 'login',
      'name' => 'name',
      'organization' => 'organization',
    );
}
