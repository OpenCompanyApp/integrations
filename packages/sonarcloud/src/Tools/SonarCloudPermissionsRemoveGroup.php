<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a permission from a group. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. The group id or group name must be provided, not both. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/remove_group.
 */
class SonarCloudPermissionsRemoveGroup extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_remove_group';
    protected const DESCRIPTION = 'Remove a permission from a group. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. The group id or group name must be provided, not both. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/permissions/remove_group.';
    protected const PARAMETERS = array (
      'group_id' => array (
        'type' => 'string',
        'description' => 'Group id (deprecated). Use \'groupName\' and \'organization\' instead.',
        'required' => false,
      ),
      'group_name' => array (
        'type' => 'string',
        'description' => 'Group name or \'anyone\' (case insensitive)',
        'required' => false,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization, used when group name is set',
        'required' => false,
      ),
      'permission' => array (
        'type' => 'string',
        'description' => 'Permission- Possible values for global permissions: admin, profileadmin, gateadmin, scan, provisioning; - Possible values for project permissions admin, codeviewer, issueadmin, securityhotspotadmin, architectureadmin, scan, user;',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'Project id',
        'required' => false,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/remove_group';
    protected const PARAM_MAP = array (
      'groupId' => 'group_id',
      'groupName' => 'group_name',
      'organization' => 'organization',
      'permission' => 'permission',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
