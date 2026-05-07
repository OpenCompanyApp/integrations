<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Delete a permission template. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/delete_template.
 */
class SonarCloudPermissionsDeleteTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_delete_template';
    protected const DESCRIPTION = 'Delete a permission template. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/delete_template.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization, used when group name is set',
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
    protected const PATH = '/api/permissions/delete_template';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
