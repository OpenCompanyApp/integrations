<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Set a permission template as default. Requires the permission 'Administer' on the organization..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/permissions/set_default_template.
 */
class SonarCloudPermissionsSetDefaultTemplate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_permissions_set_default_template';
    protected const DESCRIPTION = 'Set a permission template as default. Requires the permission \'Administer\' on the organization.

Official SonarCloud Web API endpoint: POST /api/permissions/set_default_template.';
    protected const PARAMETERS = array (
      'organization' => array (
        'type' => 'string',
        'description' => 'Key of organization, used when group name is set',
        'required' => false,
      ),
      'qualifier' => array (
        'type' => 'string',
        'description' => 'Project qualifier. Filter the results with the specified qualifier. Possible values are:- TRK - Projects;',
        'required' => false,
        'enum' => array (
          'TRK',
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
    protected const PATH = '/api/permissions/set_default_template';
    protected const PARAM_MAP = array (
      'organization' => 'organization',
      'qualifier' => 'qualifier',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
