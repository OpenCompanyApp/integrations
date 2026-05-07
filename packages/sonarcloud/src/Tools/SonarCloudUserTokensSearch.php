<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * List the access tokens of the authenticated user. Field 'lastConnectionDate' is only updated every hour, so it may not be accurate, for instance when a user is using a token many times in less than one hour..
 *
 * Maps to the official SonarCloud Web API endpoint GET /api/user_tokens/search.
 */
class SonarCloudUserTokensSearch extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_user_tokens_search';
    protected const DESCRIPTION = 'List the access tokens of the authenticated user. Field \'lastConnectionDate\' is only updated every hour, so it may not be accurate, for instance when a user is using a token many times in less than one hour.

Official SonarCloud Web API endpoint: GET /api/user_tokens/search.';
    protected const PARAMETERS = array (
      'login' => array (
        'type' => 'string',
        'description' => 'Deprecated and ignored. Tokens are always listed for the authenticated user.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/api/user_tokens/search';
    protected const PARAM_MAP = array (
      'login' => 'login',
    );
}
