<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Revoke multiple tokens
 *
 * Maps to Fastly generated client operation TokensApi::bulkRevokeTokens (DELETE /tokens).
 */
class FastlyTokensBulkRevokeTokens extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_bulk_revoke_tokens';
    protected const DESCRIPTION = 'Revoke multiple tokens

Official Fastly client operation: TokensApi::bulkRevokeTokens
Endpoint: DELETE /tokens

Revoke multiple tokens';
    protected const PARAMETERS = array (
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_bulk_revoke_tokens',
  'class' => 'FastlyTokensBulkRevokeTokens',
  'api_class' => 'TokensApi',
  'method_name' => 'bulkRevokeTokens',
  'method' => 'DELETE',
  'path' => '/tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Revoke multiple tokens',
  'description' => 'Revoke multiple tokens',
  'type' => 'write',
  'parameters' =>
  array (
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}
