<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a setting value. Either 'value' or 'values' must be provided. The settings defined in conf/sonar.properties are read-only and can't be changed. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the specified component;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/settings/set.
 */
class SonarQubeSettingsSet extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_settings_set';
    protected const DESCRIPTION = 'Update a setting value. Either \'value\' or \'values\' must be provided. The settings defined in conf/sonar.properties are read-only and can\'t be changed. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the specified component;

Official SonarQube Web API endpoint: POST /api/settings/set.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key. Only keys for projects, applications, portfolios or subportfolios are accepted.',
        'required' => false,
      ),
      'field_values' => array (
        'type' => 'string',
        'description' => 'Setting field values. To set several values, the parameter must be called once for each value.',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Setting key',
        'required' => true,
      ),
      'value' => array (
        'type' => 'string',
        'description' => 'Setting value. To reset a value, please use the reset web service.',
        'required' => false,
      ),
      'values' => array (
        'type' => 'string',
        'description' => 'Setting multi value. To set several values, the parameter must be called once for each value.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/settings/set';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'fieldValues' => 'field_values',
      'key' => 'key',
      'value' => 'value',
      'values' => 'values',
    );
}
