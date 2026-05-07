<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get recent logs for a hook.
 *
 * Maps to GET /api/hooks/{id}/recent-logs in the official Logto OpenAPI source.
 */
class LogtoListHookRecentLogs extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_hook_recent_logs',
  'class' => 'LogtoListHookRecentLogs',
  'method' => 'GET',
  'path' => '/api/hooks/{id}/recent-logs',
  'operation_id' => 'ListHookRecentLogs',
  'summary' => 'Get recent logs for a hook',
  'description' => 'Get recent logs that match the given query for the specified hook with pagination.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the hook.',
    ),
    'log_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The log key to filter logs.',
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
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'logKey' => 'log_key',
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
