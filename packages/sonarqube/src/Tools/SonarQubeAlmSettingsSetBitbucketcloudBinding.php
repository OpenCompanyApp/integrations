<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Bind a Bitbucket Cloud setting to a project. If the project was already bound to a different Bitbucket Cloud setting, the binding will be updated to the new one.Requires the 'Administer' permission on the project.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/set_bitbucketcloud_binding.
 */
class SonarQubeAlmSettingsSetBitbucketcloudBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_set_bitbucketcloud_binding';
    protected const DESCRIPTION = 'Bind a Bitbucket Cloud setting to a project. If the project was already bound to a different Bitbucket Cloud setting, the binding will be updated to the new one.Requires the \'Administer\' permission on the project

Official SonarQube Web API endpoint: POST /api/alm_settings/set_bitbucketcloud_binding.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud setting key',
        'required' => true,
      ),
      'monorepo' => array (
        'type' => 'string',
        'description' => 'Is this project part of a monorepo',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
      'repository' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud repository key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/set_bitbucketcloud_binding';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'monorepo' => 'monorepo',
      'project' => 'project',
      'repository' => 'repository',
    );
}
