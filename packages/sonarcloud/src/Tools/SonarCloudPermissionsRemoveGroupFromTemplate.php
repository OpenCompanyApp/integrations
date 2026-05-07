<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a group from a permission template. The group id or group name must be provided. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/remove_group_from_template.
 */
class SonarCloudPermissionsRemoveGroupFromTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_remove_group_from_template';
    protected const DESCRIPTION = 'Remove a group from a permission template. The group id or group name must be provided. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/remove_group_from_template.';
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
        'description' => 'Permission- Possible values for project permissions admin, codeviewer, issueadmin, securityhotspotadmin, architectureadmin, scan, user;',
        'required' => true,
        'enum' => array (
          'admin',
          'codeviewer',
          'issueadmin',
          'securityhotspotadmin',
          'architectureadmin',
          'scan',
          'user',
        ),
      ),
      'template_id' => array (
        'type' => 'string',
        'description' => 'Template id',
        'required' => false,
      ),
      'template_name' => array (
        'type' => 'string',
        'description' => 'Template name',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/remove_group_from_template';
    protected const PARAM_MAP = array (
      'groupId' => 'group_id',
      'groupName' => 'group_name',
      'organization' => 'organization',
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
