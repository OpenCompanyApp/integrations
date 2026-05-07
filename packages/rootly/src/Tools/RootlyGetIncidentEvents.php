<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident event.
 *
 * Maps to the official Rootly endpoint get /v1/events/{id}.
 */
class RootlyGetIncidentEvents extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_events';
    protected const DESCRIPTION = 'Retrieves an incident event

Official Rootly endpoint: GET /v1/events/{id}

Retrieves a specific incident_event by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/events/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
