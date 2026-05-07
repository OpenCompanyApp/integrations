<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List settings values. If no value has been set for a setting, then the default value is returned. The settings from conf/sonar.properties are excluded from results. Requires 'Browse' or 'Execute Analysis' permission when a component is specified. Secured settings values are not returned by the endpoint..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/settings/values.
 */
class SonarQubeSettingsValues extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_settings_values';
    protected const DESCRIPTION = 'List settings values. If no value has been set for a setting, then the default value is returned. The settings from conf/sonar.properties are excluded from results. Requires \'Browse\' or \'Execute Analysis\' permission when a component is specified. Secured settings values are not returned by the endpoint.

Official SonarQube Web API endpoint: GET /api/settings/values.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => false,
      ),
      'keys' => array (
        'type' => 'string',
        'description' => 'List of setting keys',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/settings/values';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'keys' => 'keys',
    );
}
