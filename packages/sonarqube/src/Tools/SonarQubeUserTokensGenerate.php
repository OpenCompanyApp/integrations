<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Generate a user access token. Please keep your tokens secret. They enable to authenticate and analyze projects. It requires administration permissions to specify a 'login' and generate a token for another user. Otherwise, a token is generated for the current user..
 *
 * Maps to the official SonarQube Web API endpoint POST /api/user_tokens/generate.
 */
class SonarQubeUserTokensGenerate extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_tokens_generate';
    protected const DESCRIPTION = 'Generate a user access token. Please keep your tokens secret. They enable to authenticate and analyze projects. It requires administration permissions to specify a \'login\' and generate a token for another user. Otherwise, a token is generated for the current user.

Official SonarQube Web API endpoint: POST /api/user_tokens/generate.';
    protected const PARAMETERS = array (
      'expiration_date' => array (
        'type' => 'string',
        'description' => 'The expiration date of the token being generated, in ISO 8601 format (YYYY-MM-DD). If not set, default to no expiration.',
        'required' => false,
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login. If not set, the token is generated for the authenticated user.',
        'required' => false,
      ),
      'name' => array (
        'type' => 'string',
        'description' => 'Token name',
        'required' => true,
      ),
      'project_key' => array (
        'type' => 'string',
        'description' => 'The key of the only project that can be analyzed by the PROJECT_ANALYSIS_TOKEN being generated.',
        'required' => false,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'Token Type. If this parameters is set to PROJECT_ANALYSIS_TOKEN, it is necessary to provide the projectKey parameter too.',
        'required' => false,
        'enum' => array (
          'USER_TOKEN',
          'GLOBAL_ANALYSIS_TOKEN',
          'PROJECT_ANALYSIS_TOKEN',
        ),
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/user_tokens/generate';
    protected const PARAM_MAP = array (
      'expirationDate' => 'expiration_date',
      'login' => 'login',
      'name' => 'name',
      'projectKey' => 'project_key',
      'type' => 'type',
    );
}
