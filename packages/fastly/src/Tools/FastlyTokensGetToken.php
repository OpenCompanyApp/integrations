<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a token
 *
 * Maps to Fastly generated client operation TokensApi::getToken (GET /tokens/{token_id}).
 */
class FastlyTokensGetToken extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_get_token';
    protected const DESCRIPTION = 'Get a token

Official Fastly client operation: TokensApi::getToken
Endpoint: GET /tokens/{token_id}

Get a token';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `token_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_get_token',
  'class' => 'FastlyTokensGetToken',
  'api_class' => 'TokensApi',
  'method_name' => 'getToken',
  'method' => 'GET',
  'path' => '/tokens/{token_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a token',
  'description' => 'Get a token',
  'type' => 'read',
  'parameters' =>
  array (
    'token_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `token_id`.',
    ),
  ),
  'path_params' =>
  array (
    'token_id' => 'token_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
