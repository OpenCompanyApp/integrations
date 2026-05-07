<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Revoke a token
 *
 * Maps to Fastly generated client operation TokensApi::revokeToken (DELETE /tokens/{token_id}).
 */
class FastlyTokensRevokeToken extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_revoke_token';
    protected const DESCRIPTION = 'Revoke a token

Official Fastly client operation: TokensApi::revokeToken
Endpoint: DELETE /tokens/{token_id}

Revoke a token';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `token_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_revoke_token',
  'class' => 'FastlyTokensRevokeToken',
  'api_class' => 'TokensApi',
  'method_name' => 'revokeToken',
  'method' => 'DELETE',
  'path' => '/tokens/{token_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Revoke a token',
  'description' => 'Revoke a token',
  'type' => 'write',
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
