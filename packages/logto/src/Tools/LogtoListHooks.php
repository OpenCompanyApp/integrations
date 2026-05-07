<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get hooks.
 *
 * Maps to GET /api/hooks in the official Logto OpenAPI source.
 */
class LogtoListHooks extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_hooks',
  'class' => 'LogtoListHooks',
  'method' => 'GET',
  'path' => '/api/hooks',
  'operation_id' => 'ListHooks',
  'summary' => 'Get hooks',
  'description' => 'Get a list of hooks with optional pagination.',
  'parameters' =>
  array (
    'include_execution_stats' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Whether to include execution stats in the response.',
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
    'includeExecutionStats' => 'include_execution_stats',
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
