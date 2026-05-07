<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete the DevOps Platform binding of a project. Requires the 'Administer' permission on the project.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/delete_binding.
 */
class SonarQubeAlmSettingsDeleteBinding extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_delete_binding';
    protected const DESCRIPTION = 'Delete the DevOps Platform binding of a project. Requires the \'Administer\' permission on the project

Official SonarQube Web API endpoint: POST /api/alm_settings/delete_binding.';
    protected const PARAMETERS = array (
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/delete_binding';
    protected const PARAM_MAP = array (
      'project' => 'project',
    );
}
