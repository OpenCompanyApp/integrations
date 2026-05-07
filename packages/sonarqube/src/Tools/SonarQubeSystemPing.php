<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Answers "pong" as plain-text.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/system/ping.
 */
class SonarQubeSystemPing extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_system_ping';
    protected const DESCRIPTION = 'Answers "pong" as plain-text

Official SonarQube Web API endpoint: GET /api/system/ping.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/system/ping';
    protected const PARAM_MAP = array (
);
}
