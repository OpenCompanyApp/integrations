<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Version of SonarQube in plain text.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/server/version.
 */
class SonarQubeServerVersion extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_server_version';
    protected const DESCRIPTION = 'Version of SonarQube in plain text

Official SonarQube Web API endpoint: GET /api/server/version.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/server/version';
    protected const PARAM_MAP = array (
);
}
