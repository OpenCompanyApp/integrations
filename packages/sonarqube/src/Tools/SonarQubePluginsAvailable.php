<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the list of all the plugins available for installation on the SonarQube instance, sorted by plugin name. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response. Update status values are: - COMPATIBLE: plugin is compatible with current SonarQube instance.; - INCOMPATIBLE: plugin is not compatible with current SonarQube instance.; - REQUIRES_SYSTEM_UPGRADE: plugin requires SonarQube to be upgraded before being installed.; - DEPS_REQUIRE_SYSTEM_UPGRADE: at least one plugin on which the plugin is dependent requires SonarQube to be upgraded.; Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/plugins/available.
 */
class SonarQubePluginsAvailable extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_available';
    protected const DESCRIPTION = 'Get the list of all the plugins available for installation on the SonarQube instance, sorted by plugin name. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response. Update status values are: - COMPATIBLE: plugin is compatible with current SonarQube instance.; - INCOMPATIBLE: plugin is not compatible with current SonarQube instance.; - REQUIRES_SYSTEM_UPGRADE: plugin requires SonarQube to be upgraded before being installed.; - DEPS_REQUIRE_SYSTEM_UPGRADE: at least one plugin on which the plugin is dependent requires SonarQube to be upgraded.; Require \'Administer System\' permission.

Official SonarQube Web API endpoint: GET /api/plugins/available.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/plugins/available';
    protected const PARAM_MAP = array (
);
}
