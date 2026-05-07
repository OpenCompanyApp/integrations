<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Restarts server. Requires 'Administer System' permission. Performs a full restart of the Web, Search and Compute Engine Servers processes. Does not reload sonar.properties..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/system/restart.
 */
class SonarQubeSystemRestart extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_restart';
    protected const DESCRIPTION = 'Restarts server. Requires \'Administer System\' permission. Performs a full restart of the Web, Search and Compute Engine Servers processes. Does not reload sonar.properties.

Official SonarQube Web API endpoint: POST /api/system/restart.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/system/restart';
    protected const PARAM_MAP = array (
);
}
