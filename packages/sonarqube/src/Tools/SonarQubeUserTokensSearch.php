<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * List the access tokens of a user. The login must exist and active. Field 'lastConnectionDate' is only updated every hour, so it may not be accurate, for instance when a user is using a token many times in less than one hour. It requires administration permissions to specify a 'login' and list the tokens of another user. Otherwise, tokens for the current user are listed. Authentication is required for this API endpoint.
 *
 * Maps to the official SonarQube Web API endpoint GET /api/user_tokens/search.
 */
class SonarQubeUserTokensSearch extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_user_tokens_search';
    protected const DESCRIPTION = 'List the access tokens of a user. The login must exist and active. Field \'lastConnectionDate\' is only updated every hour, so it may not be accurate, for instance when a user is using a token many times in less than one hour. It requires administration permissions to specify a \'login\' and list the tokens of another user. Otherwise, tokens for the current user are listed. Authentication is required for this API endpoint

Official SonarQube Web API endpoint: GET /api/user_tokens/search.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/user_tokens/search';
    protected const PARAM_MAP = array (
      'login' => 'login',
    );
}
