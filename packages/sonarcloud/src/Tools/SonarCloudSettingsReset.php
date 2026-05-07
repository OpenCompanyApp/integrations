<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a setting value. The settings defined in conf/sonar.properties are read-only and can't be changed. Requires the permission 'Administer' on the specified component..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/settings/reset.
 */
class SonarCloudSettingsReset extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_settings_reset';
    protected const DESCRIPTION = 'Remove a setting value. The settings defined in conf/sonar.properties are read-only and can\'t be changed. Requires the permission \'Administer\' on the specified component.

Official SonarCloud Web API endpoint: POST /api/settings/reset.';
    protected const PARAMETERS = array (
      'branch' => array (
        'type' => 'string',
        'description' => 'Branch key',
        'required' => false,
      ),
      'component' => array (
        'type' => 'string',
        'description' => 'Component key',
        'required' => false,
      ),
      'keys' => array (
        'type' => 'string',
        'description' => 'Comma-separated list of keys',
        'required' => true,
      ),
      'organization' => array (
        'type' => 'string',
        'description' => 'Organization key',
        'required' => false,
      ),
      'pull_request' => array (
        'type' => 'string',
        'description' => 'Pull request id',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/settings/reset';
    protected const PARAM_MAP = array (
      'branch' => 'branch',
      'component' => 'component',
      'keys' => 'keys',
      'organization' => 'organization',
      'pullRequest' => 'pull_request',
    );
}
