<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a group. The default groups cannot be deleted. 'id' or 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_groups/delete.
 */
class SonarCloudUserGroupsDelete extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_groups_delete';
    protected const DESCRIPTION = 'Delete a group. The default groups cannot be deleted. \'id\' or \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarCloud Web API endpoint: POST /api/user_groups/delete.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'Group id',
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
    protected const PATH = '/api/user_groups/delete';
    protected const PARAM_MAP = array (
      'id' => 'id',
      'name' => 'name',
      'organization' => 'organization',
    );
}
