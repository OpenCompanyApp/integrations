<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get log.
 *
 * Maps to GET /api/logs/{id} in the official Logto OpenAPI source.
 */
class LogtoGetLog extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_log',
  'class' => 'LogtoGetLog',
  'method' => 'GET',
  'path' => '/api/logs/{id}',
  'operation_id' => 'GetLog',
  'summary' => 'Get log',
  'description' => 'Get log details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the log.',
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
