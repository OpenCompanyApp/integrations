<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident event functionality.
 *
 * Maps to the official Rootly endpoint post /v1/events/{incident_event_id}/functionalities.
 */
class RootlyCreateIncidentEventFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_event_functionality';
    protected const DESCRIPTION = 'Creates an incident event functionality

Official Rootly endpoint: POST /v1/events/{incident_event_id}/functionalities

Creates a new event functionality from provided data';
    protected const PARAMETERS = array (
  'incident_event_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_event_id parameter.',
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
    protected const PATH = '/v1/events/{incident_event_id}/functionalities';
    protected const PATH_PARAMS = array (
  'incident_event_id' => 'incident_event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
