<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an incident event.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/events/{event_id}.
 */
class FireHydrantGetIncidentEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_event';
    protected const DESCRIPTION = 'Get an incident event

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/events/{event_id}

Retrieve a single event for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'event_id' =>
  array (
    'type' => 'string',
    'description' => 'event_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/events/{event_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'event_id' => 'event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
