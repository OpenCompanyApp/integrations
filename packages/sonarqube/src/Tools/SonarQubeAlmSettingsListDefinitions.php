<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List DevOps Platform Settings, sorted by created date. Requires the 'Administer System' permission.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/alm_settings/list_definitions.
 */
class SonarQubeAlmSettingsListDefinitions extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_settings_list_definitions';
    protected const DESCRIPTION = 'List DevOps Platform Settings, sorted by created date. Requires the \'Administer System\' permission

Official SonarQube Web API endpoint: GET /api/alm_settings/list_definitions.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/alm_settings/list_definitions';
    protected const PARAM_MAP = array (
);
}
