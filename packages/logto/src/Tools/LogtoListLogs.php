<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get logs.
 *
 * Maps to GET /api/logs in the official Logto OpenAPI source.
 */
class LogtoListLogs extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_logs',
  'class' => 'LogtoListLogs',
  'method' => 'GET',
  'path' => '/api/logs',
  'operation_id' => 'ListLogs',
  'summary' => 'Get logs',
  'description' => 'Get logs that match the given query with pagination.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter logs by user ID.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter logs by application ID.',
    ),
    'log_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter logs by log key.',
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
    'userId' => 'user_id',
    'applicationId' => 'application_id',
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
