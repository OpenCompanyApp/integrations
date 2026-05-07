<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Check credentials..
 *
 * Maps to the official SonarQube Web API endpoint GET /api/authentication/validate.
 */
class SonarQubeAuthenticationValidate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_authentication_validate';
    protected const DESCRIPTION = 'Check credentials.

Official SonarQube Web API endpoint: GET /api/authentication/validate.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/authentication/validate';
    protected const PARAM_MAP = array (
);
}
