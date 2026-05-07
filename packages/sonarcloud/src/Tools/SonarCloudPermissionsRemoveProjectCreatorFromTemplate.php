<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a project creator from a permission template. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/remove_project_creator_from_template.
 */
class SonarCloudPermissionsRemoveProjectCreatorFromTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_remove_project_creator_from_template';
    protected const DESCRIPTION = 'Remove a project creator from a permission template. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/remove_project_creator_from_template.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/permissions/remove_project_creator_from_template';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
