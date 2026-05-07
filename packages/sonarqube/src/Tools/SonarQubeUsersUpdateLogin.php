<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a user login. A login can be updated many times. Requires Administer System permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/update_login.
 */
class SonarQubeUsersUpdateLogin extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_update_login';
    protected const DESCRIPTION = 'Update a user login. A login can be updated many times. Requires Administer System permission

Official SonarQube Web API endpoint: POST /api/users/update_login.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'The current login (case-sensitive)',
        'required' => true,
      ),
      'new_login' => array (
        'type' => 'string',
        'description' => 'The new login. It must not already exist.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/update_login';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'newLogin' => 'new_login',
    );
}
