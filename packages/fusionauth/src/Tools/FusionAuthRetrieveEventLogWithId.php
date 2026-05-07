<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Event Log With Id.
 *
 * Maps to GET /api/system/event-log/{eventLogId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEventLogWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_event_log_with_id',
  'class' => 'FusionAuthRetrieveEventLogWithId',
  'method' => 'GET',
  'path' => '/api/system/event-log/{eventLogId}',
  'operation_id' => 'retrieveEventLogWithId',
  'summary' => 'retrieve Event Log With Id',
  'description' => 'Retrieves a single event log for the given Id.',
  'parameters' =>
  array (
    'event_log_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the event log to retrieve.',
    ),
  ),
  'path_params' =>
  array (
    'eventLogId' => 'event_log_id',
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
