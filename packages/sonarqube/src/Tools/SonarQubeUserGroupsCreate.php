<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a group. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_groups/create.
 */
class SonarQubeUserGroupsCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_create';
    protected const DESCRIPTION = 'Create a group. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/user_groups/create.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'Description for the new group. A group description cannot be larger than 200 characters.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name for the new group. A group name cannot be larger than 255 characters and must be unique. The value \'anyone\' (whatever the case) is reserved and cannot be used.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_groups/create';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'name' => 'name',
    );
}
