<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update a permission template. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/update_template.
 */
class SonarCloudPermissionsUpdateTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_update_template';
    protected const DESCRIPTION = 'Update a permission template. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/update_template.';
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
