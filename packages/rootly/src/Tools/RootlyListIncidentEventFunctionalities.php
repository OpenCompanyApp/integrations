<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident event functionalities.
 *
 * Maps to the official Rootly endpoint get /v1/events/{incident_event_id}/functionalities.
 */
class RootlyListIncidentEventFunctionalities extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_event_functionalities';
    protected const DESCRIPTION = 'List incident event functionalities

Official Rootly endpoint: GET /v1/events/{incident_event_id}/functionalities

List incident event functionalities';
    protected const PARAMETERS = array (
  'incident_event_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_event_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/events/{incident_event_id}/functionalities';
    protected const PATH_PARAMS = array (
  'incident_event_id' => 'incident_event_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
