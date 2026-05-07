<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Revoke a user access token. It requires administration permissions to specify a 'login' and revoke a token for another user. Otherwise, the token for the current user is revoked..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_tokens/revoke.
 */
class SonarQubeUserTokensRevoke extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_tokens_revoke';
    protected const DESCRIPTION = 'Revoke a user access token. It requires administration permissions to specify a \'login\' and revoke a token for another user. Otherwise, the token for the current user is revoked.

Official SonarQube Web API endpoint: POST /api/user_tokens/revoke.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Token name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_tokens/revoke';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'name' => 'name',
    );
}
