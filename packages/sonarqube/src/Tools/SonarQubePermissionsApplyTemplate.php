<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Apply a permission template to one project. The project id or project key must be provided. The template id or name must be provided. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/apply_template.
 */
class SonarQubePermissionsApplyTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_apply_template';
    protected const DESCRIPTION = 'Apply a permission template to one project. The project id or project key must be provided. The template id or name must be provided. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/apply_template.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/api/permissions/apply_template';
    protected const PARAM_MAP = array (
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
