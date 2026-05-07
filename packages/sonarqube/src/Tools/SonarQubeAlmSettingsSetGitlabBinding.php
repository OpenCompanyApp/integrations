<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Bind a GitLab instance to a project. If the project was already bound to a previous Gitlab instance, the binding will be updated to the new one.Requires the 'Administer' permission on the project.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/set_gitlab_binding.
 */
class SonarQubeAlmSettingsSetGitlabBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_set_gitlab_binding';
    protected const DESCRIPTION = 'Bind a GitLab instance to a project. If the project was already bound to a previous Gitlab instance, the binding will be updated to the new one.Requires the \'Administer\' permission on the project

Official SonarQube Web API endpoint: POST /api/alm_settings/set_gitlab_binding.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'GitLab setting key',
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
        'description' => 'GitLab project ID',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/set_gitlab_binding';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'monorepo' => 'monorepo',
      'project' => 'project',
      'repository' => 'repository',
    );
}
