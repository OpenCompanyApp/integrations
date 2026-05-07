<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Add a user to a permission template. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/add_user_to_template.
 */
class SonarCloudPermissionsAddUserToTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_add_user_to_template';
    protected const DESCRIPTION = 'Add a user to a permission template. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/add_user_to_template.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
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
    protected const PATH = '/api/permissions/add_user_to_template';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'organization' => 'organization',
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
