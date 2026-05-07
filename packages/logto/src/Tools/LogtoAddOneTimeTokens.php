<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create one-time token.
 *
 * Maps to POST /api/one-time-tokens in the official Logto OpenAPI source.
 */
class LogtoAddOneTimeTokens extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_one_time_tokens',
  'class' => 'LogtoAddOneTimeTokens',
  'method' => 'POST',
  'path' => '/api/one-time-tokens',
  'operation_id' => 'AddOneTimeTokens',
  'summary' => 'Create one-time token',
  'description' => 'Create a new one-time token associated with an email address. The token can be used for verification purposes and has an expiration time.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
