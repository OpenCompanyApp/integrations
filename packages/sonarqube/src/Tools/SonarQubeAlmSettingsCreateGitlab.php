<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create GitLab instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/create_gitlab.
 */
class SonarQubeAlmSettingsCreateGitlab extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_create_gitlab';
    protected const DESCRIPTION = 'Create GitLab instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/create_gitlab.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the GitLab instance setting',
        'required' => true,
      ),
      'personal_access_token' => array (
        'type' => 'string',
        'description' => 'GitLab personal access token',
        'required' => true,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'GitLab API URL',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/create_gitlab';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'personalAccessToken' => 'personal_access_token',
      'url' => 'url',
    );
}
