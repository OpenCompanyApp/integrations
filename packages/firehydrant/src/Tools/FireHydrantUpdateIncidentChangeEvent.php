<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a change attached to an incident.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/related_change_events/{related_change_event_id}.
 */
class FireHydrantUpdateIncidentChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_change_event';
    protected const DESCRIPTION = 'Update a change attached to an incident

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/related_change_events/{related_change_event_id}

Update a change attached to an incident';
    protected const PARAMETERS = array (
  'related_change_event_id' =>
  array (
    'type' => 'string',
    'description' => 'related_change_event_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/related_change_events/{related_change_event_id}';
    protected const PATH_PARAMS = array (
  'related_change_event_id' => 'related_change_event_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
