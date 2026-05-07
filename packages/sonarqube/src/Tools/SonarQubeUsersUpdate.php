<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Update a user. Requires Administer System permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/update.
 */
class SonarQubeUsersUpdate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_update';
    protected const DESCRIPTION = 'Update a user. Requires Administer System permission

Official SonarQube Web API endpoint: POST /api/users/update.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'email' => array (
        'type' => 'string',
        'description' => 'User email',
        'required' => false,
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'User name',
        'required' => false,
      ),
      'scm_account' => array (
        'type' => 'string',
        'description' => 'SCM accounts. To set several values, the parameter must be called once for each value.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/update';
    protected const PARAM_MAP = array (
      'email' => 'email',
      'login' => 'login',
      'name' => 'name',
      'scmAccount' => 'scm_account',
    );
}
