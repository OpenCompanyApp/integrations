<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Count number of project bound to an DevOps Platform setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_settings/count_binding.
 */
class SonarQubeAlmSettingsCountBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_count_binding';
    protected const DESCRIPTION = 'Count number of project bound to an DevOps Platform setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: GET /api/alm_settings/count_binding.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform setting key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_settings/count_binding';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
    );
}
