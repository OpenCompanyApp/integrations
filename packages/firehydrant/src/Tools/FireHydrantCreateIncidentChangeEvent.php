<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add a related change to an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/related_change_events.
 */
class FireHydrantCreateIncidentChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_change_event';
    protected const DESCRIPTION = 'Add a related change to an incident

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/related_change_events

Add a related change to an incident. Changes added to an incident can be causes, fixes, or suspects. To remove a change from an incident, the type field should be set to dismissed.';
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
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/related_change_events';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
