<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident event functionality.
 *
 * Maps to the official Rootly endpoint get /v1/incident_event_functionalities/{id}.
 */
class RootlyGetIncidentEventFunctionalities extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_event_functionalities';
    protected const DESCRIPTION = 'Retrieves an incident event functionality

Official Rootly endpoint: GET /v1/incident_event_functionalities/{id}

Retrieves a specific incident_event_functionality by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_event_functionalities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
