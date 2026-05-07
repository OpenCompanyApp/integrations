<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident event services.
 *
 * Maps to the official Rootly endpoint get /v1/events/{incident_event_id}/services.
 */
class RootlyListIncidentEventServices extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_event_services';
    protected const DESCRIPTION = 'List incident event services

Official Rootly endpoint: GET /v1/events/{incident_event_id}/services

List incident event services';
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
    protected const PATH = '/v1/events/{incident_event_id}/services';
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
