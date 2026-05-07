<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Logout a user..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/authentication/logout.
 */
class SonarCloudAuthenticationLogout extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_authentication_logout';
    protected const DESCRIPTION = 'Logout a user.

Official SonarCloud Web API endpoint: POST /api/authentication/logout.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/authentication/logout';
    protected const PARAM_MAP = array (
);
}
