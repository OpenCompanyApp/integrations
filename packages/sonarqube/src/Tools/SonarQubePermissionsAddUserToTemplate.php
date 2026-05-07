<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a user to a permission template. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/add_user_to_template.
 */
class SonarQubePermissionsAddUserToTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_add_user_to_template';
    protected const DESCRIPTION = 'Add a user to a permission template. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/add_user_to_template.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
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
    protected const PATH = '/api/permissions/add_user_to_template';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
