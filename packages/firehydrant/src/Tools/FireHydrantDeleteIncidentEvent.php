<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an incident event.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/events/{event_id}.
 */
class FireHydrantDeleteIncidentEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_event';
    protected const DESCRIPTION = 'Delete an incident event

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/events/{event_id}

Delete an event for an incident';
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
    protected const METHOD = 'delete';
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
