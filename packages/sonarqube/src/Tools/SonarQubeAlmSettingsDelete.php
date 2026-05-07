<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Delete an DevOps Platform Setting. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_settings/delete.
 */
class SonarQubeAlmSettingsDelete extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_delete';
    protected const DESCRIPTION = 'Delete an DevOps Platform Setting. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: POST /api/alm_settings/delete.';
    protected const PARAMETERS = array (
      'key' => array (
        'type' => 'string',
        'description' => 'DevOps Platform Setting key',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_settings/delete';
    protected const PARAM_MAP = array (
      'key' => 'key',
    );
}
