<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a setting value. The settings defined in conf/sonar.properties are read-only and can't be changed. Requires one of the following permissions: - 'Administer System'; - 'Administer' rights on the specified component;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/settings/reset.
 */
class SonarQubeSettingsReset extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_settings_reset';
    protected const DESCRIPTION = 'Remove a setting value. The settings defined in conf/sonar.properties are read-only and can\'t be changed. Requires one of the following permissions: - \'Administer System\'; - \'Administer\' rights on the specified component;

Official SonarQube Web API endpoint: POST /api/settings/reset.';
    protected const PARAMETERS = array (
      'component' => array (
        'type' => 'string',
        'description' => 'Component key. Only keys for projects, applications, portfolios or subportfolios are accepted.',
        'required' => false,
      ),
      'keys' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of keys',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/settings/reset';
    protected const PARAM_MAP = array (
      'component' => 'component',
      'keys' => 'keys',
    );
}
