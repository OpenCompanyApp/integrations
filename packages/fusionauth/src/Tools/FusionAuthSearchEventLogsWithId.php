<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Event Logs With Id.
 *
 * Maps to POST /api/system/event-log/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchEventLogsWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_event_logs_with_id',
  'class' => 'FusionAuthSearchEventLogsWithId',
  'method' => 'POST',
  'path' => '/api/system/event-log/search',
  'operation_id' => 'searchEventLogsWithId',
  'summary' => 'search Event Logs With Id',
  'description' => 'Searches the event logs with the specified criteria and pagination.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
