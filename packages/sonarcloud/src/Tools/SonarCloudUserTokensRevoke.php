<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Revoke an access token of the authenticated user..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_tokens/revoke.
 */
class SonarCloudUserTokensRevoke extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_tokens_revoke';
    protected const DESCRIPTION = 'Revoke an access token of the authenticated user.

Official SonarCloud Web API endpoint: POST /api/user_tokens/revoke.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'Deprecated and ignored. Tokens are always revoked for the authenticated user.',
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
