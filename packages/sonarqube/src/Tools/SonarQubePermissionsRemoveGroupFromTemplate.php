<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a group from a permission template. The group name must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/remove_group_from_template.
 */
class SonarQubePermissionsRemoveGroupFromTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_remove_group_from_template';
    protected const DESCRIPTION = 'Remove a group from a permission template. The group name must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/remove_group_from_template.';
    protected const PARAMETERS = array (
      'group_name' => array (
        'type' => 'string',
        'description' => 'Group name or \'anyone\' (case insensitive)',
        'required' => true,
      ),
      'permission' => array (
        'type' => 'string',
        'description' => 'Permission- Possible values for project permissions admin, codeviewer, issueadmin, securityhotspotadmin, scan, user;',
        'required' => true,
        'enum' => array (
          'admin',
          'codeviewer',
          'issueadmin',
          'securityhotspotadmin',
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
      'groupName' => 'group_name',
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
