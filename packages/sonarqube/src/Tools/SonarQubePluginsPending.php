<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Get the list of plugins which will either be installed or removed at the next startup of the SonarQube instance, sorted by plugin name. Require 'Administer System' permission..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/plugins/pending.
 */
class SonarQubePluginsPending extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_plugins_pending';
    protected const DESCRIPTION = 'Get the list of plugins which will either be installed or removed at the next startup of the SonarQube instance, sorted by plugin name. Require \'Administer System\' permission.

Official SonarQube Web API endpoint: GET /api/plugins/pending.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/plugins/pending';
    protected const PARAM_MAP = array (
);
}
