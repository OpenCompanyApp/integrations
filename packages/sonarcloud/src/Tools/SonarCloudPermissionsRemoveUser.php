<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove permission from a user. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/remove_user.
 */
class SonarCloudPermissionsRemoveUser extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_remove_user';
    protected const DESCRIPTION = 'Remove permission from a user. This service defaults to global permissions, but can be limited to project permissions by providing project id or project key. Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/permissions/remove_user.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization, used when group name is set',
        'required' => true,
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
    protected const PATH = '/api/permissions/remove_user';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'organization' => 'organization',
      'permission' => 'permission',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
    );
}
