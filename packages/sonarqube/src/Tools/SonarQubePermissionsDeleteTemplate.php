<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete a permission template. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/delete_template.
 */
class SonarQubePermissionsDeleteTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_delete_template';
    protected const DESCRIPTION = 'Delete a permission template. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/delete_template.';
    protected const PARAMETERS = array (
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
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
