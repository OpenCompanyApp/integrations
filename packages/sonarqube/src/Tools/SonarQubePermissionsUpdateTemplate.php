<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a permission template. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/update_template.
 */
class SonarQubePermissionsUpdateTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_update_template';
    protected const DESCRIPTION = 'Update a permission template. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/update_template.';
    protected const PARAMETERS = array (
      'description' => array (
        'type' => 'string',
        'description' => 'Description',
        'required' => false,
      ),
      'id' => array (
        'type' => 'string',
        'description' => 'Id',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Name',
        'required' => false,
      ),
      'project_key_pattern' => array (
        'type' => 'string',
        'description' => 'Project key pattern. Must be a valid Java regular expression',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/permissions/update_template';
    protected const PARAM_MAP = array (
      'description' => 'description',
      'id' => 'id',
      'name' => 'name',
      'projectKeyPattern' => 'project_key_pattern',
    );
}
