<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify one-time token.
 *
 * Maps to POST /api/one-time-tokens/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyOneTimeToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_one_time_token',
  'class' => 'LogtoVerifyOneTimeToken',
  'method' => 'POST',
  'path' => '/api/one-time-tokens/verify',
  'operation_id' => 'VerifyOneTimeToken',
  'summary' => 'Verify one-time token',
  'description' => 'Verify a one-time token associated with an email address. If the token is valid and not expired, it will be marked as consumed.',
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
