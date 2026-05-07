<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update Bitbucket Cloud Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/update_bitbucketcloud.
 */
class SonarQubeAlmSettingsUpdateBitbucketcloud extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_update_bitbucketcloud';
    protected const DESCRIPTION = 'Update Bitbucket Cloud Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/update_bitbucketcloud.';
    protected const PARAMETERS = array (
      'client_id' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud Client ID',
        'required' => true,
      ),
      'client_secret' => array (
        'type' => 'string',
        'description' => 'Optional new value for the Bitbucket Cloud client secret',
        'required' => false,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the Bitbucket Cloud setting',
        'required' => true,
      ),
      'new_key' => array (
        'type' => 'string',
        'description' => 'Optional new value for an unique key of the Bitbucket Cloud setting',
        'required' => false,
      ),
      'workspace' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud workspace ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/update_bitbucketcloud';
    protected const PARAM_MAP = array (
      'clientId' => 'client_id',
      'clientSecret' => 'client_secret',
      'key' => 'key',
      'newKey' => 'new_key',
      'workspace' => 'workspace',
    );
}
