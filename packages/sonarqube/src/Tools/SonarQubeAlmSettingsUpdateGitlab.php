<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update GitLab instance Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/update_gitlab.
 */
class SonarQubeAlmSettingsUpdateGitlab extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_update_gitlab';
    protected const DESCRIPTION = 'Update GitLab instance Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/update_gitlab.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'Unique key of the GitLab instance setting',
        'required' => true,
      ),
      'new_key' => array (
        'type' => 'string',
        'description' => 'Optional new value for an unique key of the GitLab instance setting',
        'required' => false,
      ),
      'personal_access_token' => array (
        'type' => 'string',
        'description' => 'GitLab personal access token',
        'required' => false,
      ),
      'url' => array (
        'type' => 'string',
        'description' => 'GitLab API URL',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/update_gitlab';
    protected const PARAM_MAP = array (
      'key' => 'key',
      'newKey' => 'new_key',
      'personalAccessToken' => 'personal_access_token',
      'url' => 'url',
    );
}
