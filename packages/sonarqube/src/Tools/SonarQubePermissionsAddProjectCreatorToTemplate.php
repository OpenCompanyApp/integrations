<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a project creator to a permission template. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/add_project_creator_to_template.
 */
class SonarQubePermissionsAddProjectCreatorToTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_add_project_creator_to_template';
    protected const DESCRIPTION = 'Add a project creator to a permission template. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/add_project_creator_to_template.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/permissions/add_project_creator_to_template';
    protected const PARAM_MAP = array (
      'permission' => 'permission',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
