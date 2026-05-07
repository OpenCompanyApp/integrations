<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve log records
 *
 * Maps to Fastly generated client operation LogExplorerApi::getLogRecords (GET /observability/log-explorer).
 */
class FastlyLogExplorerGetLogRecords extends AbstractFastlyTool
{
    protected const NAME = 'fastly_log_explorer_get_log_records';
    protected const DESCRIPTION = 'Retrieve log records

Official Fastly client operation: LogExplorerApi::getLogRecords
Endpoint: GET /observability/log-explorer

Retrieve log records';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `start`.',
  ),
  'end' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `end`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'next_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `next_cursor`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_log_explorer_get_log_records',
  'class' => 'FastlyLogExplorerGetLogRecords',
  'api_class' => 'LogExplorerApi',
  'method_name' => 'getLogRecords',
  'method' => 'GET',
  'path' => '/observability/log-explorer',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve log records',
  'description' => 'Retrieve log records',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'start' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `start`.',
    ),
    'end' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `end`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'next_cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `next_cursor`.',
    ),
    'filter' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'service_id' => 'service_id',
    'start' => 'start',
    'end' => 'end',
    'limit' => 'limit',
    'next_cursor' => 'next_cursor',
    'filter' => 'filter',
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
