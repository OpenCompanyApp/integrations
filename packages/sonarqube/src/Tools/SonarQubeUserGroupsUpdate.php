<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a group. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_groups/update.
 */
class SonarQubeUserGroupsUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_update';
    protected const DESCRIPTION = 'Update a group. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/user_groups/update.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'current_name' => array (
        'type' => 'string',
        'description' => 'Name of the group to be updated.',
        'required' => true,
      ),
      'description' => array (
        'type' => 'string',
        'description' => 'New optional description for the group. A group description cannot be larger than 200 characters. If value is not defined, then description is not changed.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'New optional name for the group. A group name cannot be larger than 255 characters and must be unique. Value \'anyone\' (whatever the case) is reserved and cannot be used. If value is empty or not defined, then name is not changed.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_groups/update';
    protected const PARAM_MAP = array (
      'currentName' => 'current_name',
      'description' => 'description',
      'name' => 'name',
    );
}
