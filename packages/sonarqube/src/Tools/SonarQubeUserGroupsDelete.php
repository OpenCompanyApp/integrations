<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a group. The default groups cannot be deleted. 'name' must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_groups/delete.
 */
class SonarQubeUserGroupsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_groups_delete';
    protected const DESCRIPTION = 'Delete a group. The default groups cannot be deleted. \'name\' must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/user_groups/delete.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'name' => array (
        'type' => 'string',
        'description' => 'Group name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_groups/delete';
    protected const PARAM_MAP = array (
      'name' => 'name',
    );
}
