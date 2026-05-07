<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Validate an DevOps Platform Setting by checking connectivity and permissions Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_settings/validate.
 */
class SonarQubeAlmSettingsValidate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_validate';
    protected const DESCRIPTION = 'Validate an DevOps Platform Setting by checking connectivity and permissions Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: GET /api/alm_settings/validate.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the DevOps Platform settings',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_settings/validate';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
