<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List tokens for the authenticated user
 *
 * Maps to Fastly generated client operation TokensApi::listTokensUser (GET /tokens).
 */
class FastlyTokensListTokensUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tokens_list_tokens_user';
    protected const DESCRIPTION = 'List tokens for the authenticated user

Official Fastly client operation: TokensApi::listTokensUser
Endpoint: GET /tokens

List tokens for the authenticated user';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_tokens_list_tokens_user',
  'class' => 'FastlyTokensListTokensUser',
  'api_class' => 'TokensApi',
  'method_name' => 'listTokensUser',
  'method' => 'GET',
  'path' => '/tokens',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List tokens for the authenticated user',
  'description' => 'List tokens for the authenticated user',
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
