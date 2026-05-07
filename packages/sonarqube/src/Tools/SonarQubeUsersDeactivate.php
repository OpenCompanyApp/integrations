<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Deactivate a user. Requires Administer System permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/deactivate.
 */
class SonarQubeUsersDeactivate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_deactivate';
    protected const DESCRIPTION = 'Deactivate a user. Requires Administer System permission

Official SonarQube Web API endpoint: POST /api/users/deactivate.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'anonymize' => array (
        'type' => 'string',
        'description' => 'Anonymize user in addition to deactivating it',
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
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/deactivate';
    protected const PARAM_MAP = array (
      'anonymize' => 'anonymize',
      'login' => 'login',
    );
}
