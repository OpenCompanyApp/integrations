<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Create a permission template. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/create_template.
 */
class SonarCloudPermissionsCreateTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_create_template';
    protected const DESCRIPTION = 'Create a permission template. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/create_template.';
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization',
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
      'organization' => 'organization',
      'projectKeyPattern' => 'project_key_pattern',
    );
}
