<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Configure a new instance of Bitbucket Cloud. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/create_bitbucketcloud.
 */
class SonarQubeAlmSettingsCreateBitbucketcloud extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_create_bitbucketcloud';
    protected const DESCRIPTION = 'Configure a new instance of Bitbucket Cloud. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/create_bitbucketcloud.';
    protected const PARAMETERS = array (
      'client_id' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud Client ID',
        'required' => true,
      ),
      'client_secret' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud Client Secret',
        'required' => true,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the Bitbucket Cloud setting',
        'required' => true,
      ),
      'workspace' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud workspace ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/create_bitbucketcloud';
    protected const PARAM_MAP = array (
      'clientId' => 'client_id',
      'clientSecret' => 'client_secret',
      'key' => 'key',
      'workspace' => 'workspace',
    );
}
