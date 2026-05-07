<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Set a permission template as default. Requires the following permission: 'Administer System'..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/permissions/set_default_template.
 */
class SonarQubePermissionsSetDefaultTemplate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_permissions_set_default_template';
    protected const DESCRIPTION = 'Set a permission template as default. Requires the following permission: \'Administer System\'.

Official SonarQube Web API endpoint: POST /api/permissions/set_default_template.';
    protected const PARAMETERS = array (
      'qualifier' => array (
        'type' => 'string',
        'description' => 'Project qualifier. Filter the results with the specified qualifier. Possible values are:- APP - Applications; - TRK - Projects; - VW - Portfolios;',
        'required' => false,
        'enum' => array (
          'APP',
          'TRK',
          'VW',
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
      'qualifier' => 'qualifier',
      'templateId' => 'template_id',
      'templateName' => 'template_name',
    );
}
