<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create Bitbucket instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/create_bitbucket.
 */
class SonarQubeAlmSettingsCreateBitbucket extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_create_bitbucket';
    protected const DESCRIPTION = 'Create Bitbucket instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/create_bitbucket.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the Bitbucket instance setting',
        'required' => true,
      ),
      'personal_access_token' => array (
        'type' => 'string',
        'description' => 'Bitbucket personal access token',
        'required' => true,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'BitBucket server API URL',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/create_bitbucket';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'personalAccessToken' => 'personal_access_token',
      'url' => 'url',
    );
}
