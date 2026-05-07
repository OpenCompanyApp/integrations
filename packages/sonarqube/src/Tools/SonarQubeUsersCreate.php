<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a user. If a deactivated user account exists with the given login, it will be reactivated. Requires Administer System permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/create.
 */
class SonarQubeUsersCreate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_create';
    protected const DESCRIPTION = 'Create a user. If a deactivated user account exists with the given login, it will be reactivated. Requires Administer System permission

Official SonarQube Web API endpoint: POST /api/users/create.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'email' => array (
        'type' => 'string',
        'description' => 'User email',
        'required' => false,
      ),
      'local' => array (
        'type' => 'string',
        'description' => 'Specify if the user should be authenticated from SonarQube server or from an external authentication system. Password should not be set when local is set to false.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'User name',
        'required' => true,
      ),
      'password' => array (
        'type' => 'string',
        'description' => 'User password. Only mandatory when creating local user, otherwise it should not be set',
        'required' => false,
      ),
      'scm_account' => array (
        'type' => 'string',
        'description' => 'List of SCM accounts. To set several values, the parameter must be called once for each value.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/create';
    protected const PARAM_MAP = array (
      'email' => 'email',
      'local' => 'local',
      'login' => 'login',
      'name' => 'name',
      'password' => 'password',
      'scmAccount' => 'scm_account',
    );
}
