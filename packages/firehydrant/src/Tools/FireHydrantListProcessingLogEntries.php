<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List alert processing log entries.
 *
 * Maps to the official FireHydrant endpoint get /v1/processing_log_entries.
 */
class FireHydrantListProcessingLogEntries extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_processing_log_entries';
    protected const DESCRIPTION = 'List alert processing log entries

Official FireHydrant endpoint: GET /v1/processing_log_entries

Processing Log Entries for a specific alert';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'integration_slug' =>
  array (
    'type' => 'string',
    'description' => 'Scopes returned log entries to a specific integration ID',
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'Scopes returned log entries to a specific connection ID',
  ),
  'of_level' =>
  array (
    'type' => 'string',
    'description' => 'Returns logs of all levels equal to or above the provided level',
    'enum' =>
    array (
      0 => 'unknown',
      1 => 'debug',
      2 => 'info',
      3 => 'warn',
      4 => 'error',
      5 => 'fatal',
    ),
  ),
  'exact_level' =>
  array (
    'type' => 'string',
    'description' => 'Returns log entries of all levels equal to the provided level',
    'enum' =>
    array (
      0 => 'unknown',
      1 => 'debug',
      2 => 'info',
      3 => 'warn',
      4 => 'error',
      5 => 'fatal',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/processing_log_entries';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'integration_slug' => 'integration_slug',
  'connection_id' => 'connection_id',
  'of_level' => 'of_level',
  'exact_level' => 'exact_level',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
