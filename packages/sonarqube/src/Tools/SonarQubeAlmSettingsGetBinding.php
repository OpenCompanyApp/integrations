<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get DevOps Platform binding of a given project. Requires the 'Browse' permission on the project.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_settings/get_binding.
 */
class SonarQubeAlmSettingsGetBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_get_binding';
    protected const DESCRIPTION = 'Get DevOps Platform binding of a given project. Requires the \'Browse\' permission on the project

Official SonarQube Web API endpoint: GET /api/alm_settings/get_binding.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_settings/get_binding';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
