<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Logout a user..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/authentication/logout.
 */
class SonarQubeAuthenticationLogout extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_authentication_logout';
    protected const DESCRIPTION = 'Logout a user.

Official SonarQube Web API endpoint: POST /api/authentication/logout.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/authentication/logout';
    protected const PARAM_MAP = array (
);
}
