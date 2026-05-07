<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get hook.
 *
 * Maps to GET /api/hooks/{id} in the official Logto OpenAPI source.
 */
class LogtoGetHook extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_hook',
  'class' => 'LogtoGetHook',
  'method' => 'GET',
  'path' => '/api/hooks/{id}',
  'operation_id' => 'GetHook',
  'summary' => 'Get hook',
  'description' => 'Get hook details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the hook.',
    ),
    'include_execution_stats' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Whether to include execution stats in the response.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'includeExecutionStats' => 'include_execution_stats',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
