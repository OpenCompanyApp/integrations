<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update a group. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_groups/update.
 */
class SonarCloudUserGroupsUpdate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_update';
    protected const DESCRIPTION = 'Update a group. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: POST /api/user_groups/update.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'New optional description for the group. A group description cannot be larger than 200 characters. If value is not defined, then description is not changed.',
        'required' => false,
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'Identifier of the group.',
        'required' => true,
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
      'description' => 'description',
      'id' => 'id',
      'name' => 'name',
    );
}
