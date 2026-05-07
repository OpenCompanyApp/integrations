<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Provide health status of SonarQube.Although global health is calculated based on both application and search nodes, detailed information is returned only for application nodes. - GREEN: SonarQube is fully operational; - YELLOW: SonarQube is usable, but it needs attention in order to be fully operational; - RED: SonarQube is not operational; Requires the 'Administer System' permission or system passcode (see sonar.web.systemPasscode in sonar.properties). When SonarQube is in safe mode (waiting or running a database upgrade), only the authentication with a system passcode is supported..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/health.
 */
class SonarQubeSystemHealth extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_health';
    protected const DESCRIPTION = 'Provide health status of SonarQube.Although global health is calculated based on both application and search nodes, detailed information is returned only for application nodes. - GREEN: SonarQube is fully operational; - YELLOW: SonarQube is usable, but it needs attention in order to be fully operational; - RED: SonarQube is not operational; Requires the \'Administer System\' permission or system passcode (see sonar.web.systemPasscode in sonar.properties). When SonarQube is in safe mode (waiting or running a database upgrade), only the authentication with a system passcode is supported.

Official SonarQube Web API endpoint: GET /api/system/health.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/health';
    protected const PARAM_MAP = array (
);
}
