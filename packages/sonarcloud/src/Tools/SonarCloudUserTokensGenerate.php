<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Generate a user access token. Please keep your tokens secret. They enable to authenticate and analyze projects. The endpoint generates a token for the logged in user..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/user_tokens/generate.
 */
class SonarCloudUserTokensGenerate extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_tokens_generate';
    protected const DESCRIPTION = 'Generate a user access token. Please keep your tokens secret. They enable to authenticate and analyze projects. The endpoint generates a token for the logged in user.

Official SonarCloud Web API endpoint: POST /api/user_tokens/generate.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'Deprecated and ignored. Tokens are always generated for the authenticated user.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Token name',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_tokens/generate';
    protected const PARAM_MAP = array (
      'login' => 'login',
      'name' => 'name',
    );
}
