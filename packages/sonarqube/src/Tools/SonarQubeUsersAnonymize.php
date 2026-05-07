<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Anonymize a deactivated user. Requires Administer System permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/users/anonymize.
 */
class SonarQubeUsersAnonymize extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_users_anonymize';
    protected const DESCRIPTION = 'Anonymize a deactivated user. Requires Administer System permission

Official SonarQube Web API endpoint: POST /api/users/anonymize.

Deprecated since SonarQube 10.4; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/users/anonymize';
    protected const PARAM_MAP = array (
      'login' => 'login',
    );
}
