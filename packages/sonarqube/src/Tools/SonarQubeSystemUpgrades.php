<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Lists available upgrades for the SonarQube instance (if any) and for each one, lists incompatible plugins and plugins requiring upgrade. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/upgrades.
 */
class SonarQubeSystemUpgrades extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_upgrades';
    protected const DESCRIPTION = 'Lists available upgrades for the SonarQube instance (if any) and for each one, lists incompatible plugins and plugins requiring upgrade. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response.

Official SonarQube Web API endpoint: GET /api/system/upgrades.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/upgrades';
    protected const PARAM_MAP = array (
);
}
