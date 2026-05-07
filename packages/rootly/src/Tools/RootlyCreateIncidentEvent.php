<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident event.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{incident_id}/events.
 */
class RootlyCreateIncidentEvent extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_event';
    protected const DESCRIPTION = 'Creates an incident event

Official Rootly endpoint: POST /v1/incidents/{incident_id}/events

Creates a new event from provided data';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/events';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
