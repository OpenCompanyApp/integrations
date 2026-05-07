<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an incident event.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/events/{event_id}.
 */
class FireHydrantUpdateIncidentEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_event';
    protected const DESCRIPTION = 'Update an incident event

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/events/{event_id}

Update a single event for an incident';
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
    protected const METHOD = 'patch';
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
