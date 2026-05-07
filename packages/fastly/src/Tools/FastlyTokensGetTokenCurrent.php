<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get the current token
 *
 * Maps to Fastly generated client operation TokensApi::getTokenCurrent (GET /tokens/self).
 */
class FastlyTokensGetTokenCurrent extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_get_token_current';
    protected const DESCRIPTION = 'Get the current token

Official Fastly client operation: TokensApi::getTokenCurrent
Endpoint: GET /tokens/self

Get the current token';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_get_token_current',
  'class' => 'FastlyTokensGetTokenCurrent',
  'api_class' => 'TokensApi',
  'method_name' => 'getTokenCurrent',
  'method' => 'GET',
  'path' => '/tokens/self',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get the current token',
  'description' => 'Get the current token',
  'type' => 'read',
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
