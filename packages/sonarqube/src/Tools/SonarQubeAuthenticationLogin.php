<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Authenticate a user..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/authentication/login.
 */
class SonarQubeAuthenticationLogin extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_authentication_login';
    protected const DESCRIPTION = 'Authenticate a user.

Official SonarQube Web API endpoint: POST /api/authentication/login.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'Login of the user',
        'required' => true,
      ),
      'password' => array (
        'type' => 'string',
        'description' => 'Password of the user',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/authentication/login';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'password' => 'password',
    );
}
