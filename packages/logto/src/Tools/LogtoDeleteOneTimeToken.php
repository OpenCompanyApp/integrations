<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete one-time token by ID.
 *
 * Maps to DELETE /api/one-time-tokens/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteOneTimeToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_one_time_token',
  'class' => 'LogtoDeleteOneTimeToken',
  'method' => 'DELETE',
  'path' => '/api/one-time-tokens/{id}',
  'operation_id' => 'DeleteOneTimeToken',
  'summary' => 'Delete one-time token by ID',
  'description' => 'Delete a one-time token by its ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the one time token.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
