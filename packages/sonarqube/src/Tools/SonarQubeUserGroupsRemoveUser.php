<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a user from a group. 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_groups/remove_user.
 */
class SonarQubeUserGroupsRemoveUser extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_remove_user';
    protected const DESCRIPTION = 'Remove a user from a group. \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/user_groups/remove_user.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Group name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_groups/remove_user';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'name' => 'name',
    );
}
