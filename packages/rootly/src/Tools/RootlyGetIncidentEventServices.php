<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident event service.
 *
 * Maps to the official Rootly endpoint get /v1/incident_event_services/{id}.
 */
class RootlyGetIncidentEventServices extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_event_services';
    protected const DESCRIPTION = 'Retrieves an incident event service

Official Rootly endpoint: GET /v1/incident_event_services/{id}

Retrieves a specific incident_event_service by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_event_services/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
