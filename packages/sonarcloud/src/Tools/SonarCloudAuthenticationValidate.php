<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Check credentials. Returns true for anonymous user..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/authentication/validate.
 */
class SonarCloudAuthenticationValidate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_authentication_validate';
    protected const DESCRIPTION = 'Check credentials. Returns true for anonymous user.

Official SonarCloud Web API endpoint: GET /api/authentication/validate.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/authentication/validate';
    protected const PARAM_MAP = array (
);
}
