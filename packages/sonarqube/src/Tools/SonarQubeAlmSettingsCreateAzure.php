<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create Azure instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/create_azure.
 */
class SonarQubeAlmSettingsCreateAzure extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_create_azure';
    protected const DESCRIPTION = 'Create Azure instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/create_azure.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the Azure Devops instance setting',
        'required' => true,
      ),
      'personal_access_token' => array (
        'type' => 'string',
        'description' => 'Azure Devops personal access token',
        'required' => true,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'Azure API URL',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/create_azure';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'personalAccessToken' => 'personal_access_token',
      'url' => 'url',
    );
}
