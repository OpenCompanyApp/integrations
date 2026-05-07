<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Revoke the current token
 *
 * Maps to Fastly generated client operation TokensApi::revokeTokenCurrent (DELETE /tokens/self).
 */
class FastlyTokensRevokeTokenCurrent extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_revoke_token_current';
    protected const DESCRIPTION = 'Revoke the current token

Official Fastly client operation: TokensApi::revokeTokenCurrent
Endpoint: DELETE /tokens/self

Revoke the current token';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_revoke_token_current',
  'class' => 'FastlyTokensRevokeTokenCurrent',
  'api_class' => 'TokensApi',
  'method_name' => 'revokeTokenCurrent',
  'method' => 'DELETE',
  'path' => '/tokens/self',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Revoke the current token',
  'description' => 'Revoke the current token',
  'type' => 'write',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
