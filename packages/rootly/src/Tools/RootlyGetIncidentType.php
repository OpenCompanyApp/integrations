<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident type.
 *
 * Maps to the official Rootly endpoint get /v1/incident_types/{id}.
 */
class RootlyGetIncidentType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_type';
    protected const DESCRIPTION = 'Retrieves an incident type

Official Rootly endpoint: GET /v1/incident_types/{id}

Retrieves a specific incident_type by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
