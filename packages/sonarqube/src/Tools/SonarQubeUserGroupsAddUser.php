<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a user to a group. 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_groups/add_user.
 */
class SonarQubeUserGroupsAddUser extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_add_user';
    protected const DESCRIPTION = 'Add a user to a group. \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/user_groups/add_user.

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
    protected const PATH = '/api/user_groups/add_user';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'name' => 'name',
    );
}
