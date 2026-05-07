<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get one-time tokens.
 *
 * Maps to GET /api/one-time-tokens in the official Logto OpenAPI source.
 */
class LogtoListOneTimeTokens extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_one_time_tokens',
  'class' => 'LogtoListOneTimeTokens',
  'method' => 'GET',
  'path' => '/api/one-time-tokens',
  'operation_id' => 'ListOneTimeTokens',
  'summary' => 'Get one-time tokens',
  'description' => 'Get a list of one-time tokens, filtering by email and status, with optional pagination.',
  'parameters' =>
  array (
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter one-time tokens by email address.',
    ),
    'status' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter one-time tokens by status.',
      'enum' =>
      array (
        0 => 'active',
        1 => 'consumed',
        2 => 'revoked',
        3 => 'expired',
      ),
    ),
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'email' => 'email',
    'status' => 'status',
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
