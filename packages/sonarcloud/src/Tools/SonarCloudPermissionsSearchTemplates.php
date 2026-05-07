<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List permission templates. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/permissions/search_templates.
 */
class SonarCloudPermissionsSearchTemplates extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_search_templates';
    protected const DESCRIPTION = 'List permission templates. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: GET /api/permissions/search_templates.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization',
        'required' => true,
      ),
      'q' => array (
        'type' => 'string',
        'description' => 'Limit search to permission template names that contain the supplied string.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/permissions/search_templates';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'q' => 'q',
    );
}
