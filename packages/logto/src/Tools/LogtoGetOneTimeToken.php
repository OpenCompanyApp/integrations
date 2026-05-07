<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get one-time token by ID.
 *
 * Maps to GET /api/one-time-tokens/{id} in the official Logto OpenAPI source.
 */
class LogtoGetOneTimeToken extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_one_time_token',
  'class' => 'LogtoGetOneTimeToken',
  'method' => 'GET',
  'path' => '/api/one-time-tokens/{id}',
  'operation_id' => 'GetOneTimeToken',
  'summary' => 'Get one-time token by ID',
  'description' => 'Get a one-time token by its ID.',
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
  'type' => 'read',
);
}
