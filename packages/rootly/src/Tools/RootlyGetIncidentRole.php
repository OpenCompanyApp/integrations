<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident role.
 *
 * Maps to the official Rootly endpoint get /v1/incident_roles/{id}.
 */
class RootlyGetIncidentRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_role';
    protected const DESCRIPTION = 'Retrieves an incident role

Official Rootly endpoint: GET /v1/incident_roles/{id}

Retrieves a specific incident_role by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
