<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Update a setting value. Either 'value' or 'values' must be provided. The settings defined in conf/sonar.properties are read-only and can't be changed. Requires the permission 'Administer' on the specified component..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/settings/set.
 */
class SonarCloudSettingsSet extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_settings_set';
    protected const DESCRIPTION = 'Update a setting value. Either \'value\' or \'values\' must be provided. The settings defined in conf/sonar.properties are read-only and can\'t be changed. Requires the permission \'Administer\' on the specified component.

Official SonarCloud Web API endpoint: POST /api/settings/set.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
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
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key (for the Enterprise plan only)',
        'required' => false,
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
      'organization' => 'organization',
      'value' => 'value',
      'values' => 'values',
    );
}
