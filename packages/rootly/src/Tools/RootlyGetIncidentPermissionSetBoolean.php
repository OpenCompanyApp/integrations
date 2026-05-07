<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident_permission_set_boolean.
 *
 * Maps to the official Rootly endpoint get /v1/incident_permission_set_booleans/{id}.
 */
class RootlyGetIncidentPermissionSetBoolean extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_permission_set_boolean';
    protected const DESCRIPTION = 'Retrieves an incident_permission_set_boolean

Official Rootly endpoint: GET /v1/incident_permission_set_booleans/{id}

Retrieves a specific incident_permission_set_boolean by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_permission_set_booleans/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
