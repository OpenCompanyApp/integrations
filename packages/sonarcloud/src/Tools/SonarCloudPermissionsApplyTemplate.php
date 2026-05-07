<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Apply a permission template to one project. The project id or project key must be provided. The template id or name must be provided. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/apply_template.
 */
class SonarCloudPermissionsApplyTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_apply_template';
    protected const DESCRIPTION = 'Apply a permission template to one project. The project id or project key must be provided. The template id or name must be provided. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/apply_template.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization, used when group name is set',
        'required' => false,
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
      'organization' => 'organization',
      'projectId' => 'project_id',
      'projectKey' => 'project_key',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
