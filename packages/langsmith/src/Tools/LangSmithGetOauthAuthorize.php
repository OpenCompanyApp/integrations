<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Initiate OAuth2 authorization.
 *
 * Maps to the official LangSmith endpoint GET /oauth/authorize.
 */
class LangSmithGetOauthAuthorize extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_oauth_authorize';
    protected const DESCRIPTION = 'Initiate OAuth2 authorization

Official endpoint: GET /oauth/authorize
Validates authorization request parameters and redirects to the frontend consent page per RFC 6749.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: response_type, client_id, redirect_uri, code_challenge, code_challenge_method, state.',
  ),
  'response_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `response_type`.',
  ),
  'client_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `client_id`.',
  ),
  'redirect_uri' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `redirect_uri`.',
  ),
  'code_challenge' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `code_challenge`.',
  ),
  'code_challenge_method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `code_challenge_method`.',
  ),
  'state' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `state`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/oauth/authorize';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'response_type',
  1 => 'client_id',
  2 => 'redirect_uri',
  3 => 'code_challenge',
  4 => 'code_challenge_method',
  5 => 'state',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
