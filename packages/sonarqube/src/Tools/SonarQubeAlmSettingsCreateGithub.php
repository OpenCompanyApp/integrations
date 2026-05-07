<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create GitHub instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/create_github.
 */
class SonarQubeAlmSettingsCreateGithub extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_create_github';
    protected const DESCRIPTION = 'Create GitHub instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/create_github.';
    protected const PARAMETERS = array (
      'app_id' => array (
        'type' => 'string',
        'description' => 'GitHub App ID',
        'required' => true,
      ),
      'client_id' => array (
        'type' => 'string',
        'description' => 'GitHub App Client ID',
        'required' => true,
      ),
      'client_secret' => array (
        'type' => 'string',
        'description' => 'GitHub App Client Secret',
        'required' => true,
      ),
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the GitHub instance setting',
        'required' => true,
      ),
      'private_key' => array (
        'type' => 'string',
        'description' => 'GitHub App private key',
        'required' => true,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'GitHub API URL',
        'required' => true,
      ),
      'webhook_secret' => array (
        'type' => 'string',
        'description' => 'GitHub App Webhook Secret',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/create_github';
    protected const PARAM_MAP = array (
      'appId' => 'app_id',
      'clientId' => 'client_id',
      'clientSecret' => 'client_secret',
      'key' => 'key',
      'privateKey' => 'private_key',
      'url' => 'url',
      'webhookSecret' => 'webhook_secret',
    );
}
