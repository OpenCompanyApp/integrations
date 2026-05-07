<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update Bitbucket instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/update_bitbucket.
 */
class SonarQubeAlmSettingsUpdateBitbucket extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_update_bitbucket';
    protected const DESCRIPTION = 'Update Bitbucket instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/update_bitbucket.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the Bitbucket instance setting',
        'required' => true,
      ),
      'new_key' => array (
        'type' => 'string',
        'description' => 'Optional new value for an unique key of the Bitbucket instance setting',
        'required' => false,
      ),
      'personal_access_token' => array (
        'type' => 'string',
        'description' => 'Bitbucket personal access token',
        'required' => false,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'Bitbucket API URL',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/update_bitbucket';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'newKey' => 'new_key',
      'personalAccessToken' => 'personal_access_token',
      'url' => 'url',
    );
}
