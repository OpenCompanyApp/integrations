<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update one-time token status.
 *
 * Maps to PUT /api/one-time-tokens/{id}/status in the official Logto OpenAPI source.
 */
class LogtoReplaceOneTimeTokenStatus extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_one_time_token_status',
  'class' => 'LogtoReplaceOneTimeTokenStatus',
  'method' => 'PUT',
  'path' => '/api/one-time-tokens/{id}/status',
  'operation_id' => 'ReplaceOneTimeTokenStatus',
  'summary' => 'Update one-time token status',
  'description' => 'Update the status of a one-time token by its ID. This can be used to mark the token as consumed or expired.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the one time token.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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
