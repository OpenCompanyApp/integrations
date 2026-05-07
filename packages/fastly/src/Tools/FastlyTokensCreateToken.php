<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a token
 *
 * Maps to Fastly generated client operation TokensApi::createToken (POST /tokens).
 */
class FastlyTokensCreateToken extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_create_token';
    protected const DESCRIPTION = 'Create a token

Official Fastly client operation: TokensApi::createToken
Endpoint: POST /tokens

Create a token';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_create_token',
  'class' => 'FastlyTokensCreateToken',
  'api_class' => 'TokensApi',
  'method_name' => 'createToken',
  'method' => 'POST',
  'path' => '/tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a token',
  'description' => 'Create a token',
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
