<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a permission template. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/create_template.
 */
class SonarQubePermissionsCreateTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_create_template';
    protected const DESCRIPTION = 'Create a permission template. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/create_template.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'Description',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name',
        'required' => true,
      ),
      'project_key_pattern' => array (
        'type' => 'string',
        'description' => 'Project key pattern. Must be a valid Java regular expression',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/create_template';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'name' => 'name',
      'projectKeyPattern' => 'project_key_pattern',
    );
}
