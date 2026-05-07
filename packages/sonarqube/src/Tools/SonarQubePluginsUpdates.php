<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Lists plugins installed on the SonarQube instance for which at least one newer version is available, sorted by plugin name. Each newer version is listed, ordered from the oldest to the newest, with its own update/compatibility status. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response. Update status values are: [COMPATIBLE, INCOMPATIBLE, REQUIRES_UPGRADE, DEPS_REQUIRE_UPGRADE]. Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/plugins/updates.
 */
class SonarQubePluginsUpdates extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_updates';
    protected const DESCRIPTION = 'Lists plugins installed on the SonarQube instance for which at least one newer version is available, sorted by plugin name. Each newer version is listed, ordered from the oldest to the newest, with its own update/compatibility status. Plugin information is retrieved from Update Center. Date and time at which Update Center was last refreshed is provided in the response. Update status values are: [COMPATIBLE, INCOMPATIBLE, REQUIRES_UPGRADE, DEPS_REQUIRE_UPGRADE]. Require \'Administer System\' permission.

Official SonarQube Web API endpoint: GET /api/plugins/updates.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/plugins/updates';
    protected const PARAM_MAP = array (
);
}
