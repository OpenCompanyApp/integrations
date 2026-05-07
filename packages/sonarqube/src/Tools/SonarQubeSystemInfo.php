<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get detailed information about system configuration. Requires 'Administer' permissions..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/info.
 */
class SonarQubeSystemInfo extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_info';
    protected const DESCRIPTION = 'Get detailed information about system configuration. Requires \'Administer\' permissions.

Official SonarQube Web API endpoint: GET /api/system/info.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/info';
    protected const PARAM_MAP = array (
);
}
